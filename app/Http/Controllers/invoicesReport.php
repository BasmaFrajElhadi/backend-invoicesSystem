<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\invoices;
use Illuminate\Http\Request;

class invoicesReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.reports.invoices_report');
    }

    public function search_invoices(Request $request)
    {
        $radio = $request->radio;
        // البحث في حالة بنوع الفاتورة
        if($radio == 1){
            // في حالة لم يتم تحديد تاريخ
            if($request->type && $request->start_at =="" && $request->end_at ==""){
                $invoices = invoices::select('*')->where('status', $request->type)->get();
                $type = $request->type;
                return view('pages.reports.invoices_report',compact('type'))->withDetails($invoices);
            }
            // في حالة  يتم تحديد تاريخ
            else{
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('status','=',$request->type)->get();
                $type = $request->type;
                return view('pages.reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);

            }
        }
        // البحث في حالة رقم الفاتورة
        else{
            $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            return view('pages.reports.invoices_report')->withDetails($invoices);
        }
    }
}
