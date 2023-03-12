<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\invoices;
use Illuminate\Http\Request;

class CustomersReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = section::all();
        return view('pages.reports.customers_report', compact('sections'));
    }

    public function search_customers(Request $request)
    {
        // في حالة لم يتم تحديد التاريخ
        if ($request->section && $request->product && $request->start_at =='' && $request->end_at=='') {
            $invoices = invoices::select('*')->where('section_id','=',$request->section)->where('product','=',$request->product)->get();
            $sections = section::all();
            return view('pages.reports.customers_report',compact('sections'))->withDetails($invoices);
        }
        // في حالة  تم تحديد تاريخ
        else{
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id', '=' , $request->section)->where('product', '=' , $request->product)->get();
            $sections = section::all();
            return view('pages.reports.customers_report',compact('sections','start_at','end_at'))->withDetails($invoices);
        }
    }
}
