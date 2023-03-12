<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\section;
use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Notifications\Add_invoice;
use Illuminate\Support\Facades\DB;
use App\Models\invoices_attachments;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('pages.invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = section::all();
        return view('pages.invoices.add_invoice', compact('sections'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_Date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_Commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat' => $request->Rate_VAT,
            'value_vat' => $request->Value_VAT,
            'total' => $request->Total,
            'status'=>'غير مدفوعة',
            'value_status'=>2,
            'note'=>$request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_invoice'=>$invoice_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'Section'=>$request->Section,
            'status'=>' غير مدفوعة',
            'value_Status'=>2,
            'note'=>$request->note,
            'user'=> (Auth::user()->name),
        ]);

        if($request->hasFile('pic')){
            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $fileName = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            invoices_attachments::create([
                'file_name'=>$fileName,
                'invoice_number'=>$invoice_number,
                'created_by'=>Auth::user()->name,
                'id_invoice'=>$invoice_id,
            ]);
            //move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/'.$invoice_number),$imageName);
        }
        $users = User::where('roles_name','like','%owner%')->where('id' , '!=' , auth()->user()->id)->get();
        Notification::send($users, new Add_invoice($invoice_id));
        return redirect()->back()->with("successful","تم الاضافة بنجاح ");
    }

    public function invoicesPaid()
    {
        $invoices = invoices::where('value_status',1)->get();
        return view('pages.invoices.invoices_paid', compact('invoices'));
    }

    public function invoicesUnpaid()
    {
        $invoices = invoices::where('value_status',2)->get();
        return view('pages.invoices.invoices_unpaid', compact('invoices'));
    }

    public function invoicesPartialPaid()
    {
        $invoices = invoices::where('value_status',3)->get();
        return view('pages.invoices.invoices_Partial', compact('invoices'));
    }

    public function showDetails($id)
    {
        $invoice = invoices::where('id',$id)->first();
        $invoiceDetails = invoices_details::where('id_invoice',$id)->get();
        $invoices_attachment = invoices_attachments::where('id_invoice',$id)->get();
        return view('pages.invoices.InvoicesDetails', compact('invoice','invoiceDetails','invoices_attachment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = invoices::where('id',$id)->first();
        $sections = section::all();
        return view('pages.invoices.Invoices_edit',compact('sections','invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, invoices $invoices)
    {
        invoices::where('id', $request->invoice_id)->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_Date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_Commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat' => $request->Rate_VAT,
            'value_vat' => $request->Value_VAT,
            'total' => $request->Total,
            'status'=>'غير مدفوعة',
            'value_status'=>2,
            'note'=>$request->note,
        ]);
        return redirect()->back()->with("successful","تم التعديل بنجاح ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Attachments = invoices_attachments::where('id_invoice', $request->invoice_id)->first();
        if (!empty($Attachments->invoice_number)) {

            Storage::disk('public_uploads')->deleteDirectory($Attachments->invoice_number);
        }
        invoices::where('id', $request->invoice_id)->forceDelete();
        return redirect()->back()->with("successful","تم الحذف بنجاح");
    }

    public function getProducts($id){
        $products = DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($products);
    }

    public function Print_invoice($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('pages.invoices.Print_invoice',compact('invoices'));
    }

    public function markAsRead_all(){
        $userUnreadNotification = Auth::user()->unreadNotifications;
        if($userUnreadNotification){
            $userUnreadNotification->markAsRead();
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function showNotification($id)
    {
        $invoice = invoices::where('id',$id)->first();
        $userUnreadNotification = DB::table('notifications')->where('data->invoice_id', $invoice->id)->pluck('id');
        DB::table('notifications')->where('id', $userUnreadNotification)->update(['read_at'=>now()]);
        return $this->showDetails($invoice->id);
    }

}
