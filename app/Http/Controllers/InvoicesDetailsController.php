<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function get_file($invoice_number, $file_name)
    {
        $files = public_path('Attachments/'.$invoice_number.'/'.$file_name);
        return response()->download($files);
    }

    public function open_file($invoice_number, $file_name)
    {
        // $files = Storage::disk('public_uploads')->getDrive()->getAdapter()->applyPathPrefix($invoice_number. '/' . $file_name);
        $files = public_path('Attachments/'.$invoice_number.'/'.$file_name);
        return response()->file($files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_detalis $invoices_detalis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_detalis $invoices_detalis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_detalis $invoices_detalis)
    {
        //
    }

    public function statusShow($id)
    {
        $invoice = invoices::where('id',$id)->first();
        return view('pages.invoices.statusUpdate',compact('invoice'));
    }


    public function statusUpdate(Request $request)
    {
        $request->status == 'مدفوعة'?$statusValue = 1:$statusValue = 3;

        invoices::where('id', $request->invoice_id)->update([
            'status'=> $request->status,
            'Payment_Date'=> $request->Payment_Date,
            'value_status'=>$statusValue,
        ]);

        invoices_details::create([
            'id_invoice'=>$request->invoice_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'Section'=>$request->Section,
            'status'=>$request->status ,
            'value_Status'=>$statusValue,
            'note'=>$request->note,
            'user'=> (Auth::user()->name),
        ]);
        return redirect()->back()->with("successful","تم تعديل حالة الدفع بنجاح ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        invoices_attachments::where('id', $request->id_file)->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        return redirect()->back()->with("successful","تم الحذف بنجاح");
    }
}
