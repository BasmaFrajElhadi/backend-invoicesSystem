<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $invoices = invoices::all();
        $invoicesPaid = invoices::where('value_status',1)->get();
        $invoicesUnpaid = invoices::where('value_status',2)->get();
        $invoicesPartialPaid = invoices::where('value_status',3)->get();
        // bar chart for invoices
        $BarChart = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->datasets([
            // الفواتير الغير مدفوعة
            [
                "label" => "الفواتير الغير مدفوعة",
                'backgroundColor' => ['#DF2E38'],
                'hoverBackgroundColor' => ['#820000'],
                'data' => [($invoicesUnpaid->count() / $invoices->count()) * 100]
            ],
            //الفواتير المدفوعة جزئيا
            [
                "label" => " الفواتير المدفوعة جزئيا",
                'backgroundColor' => ['#C7E8CA'],
                'hoverBackgroundColor' => ['#B3E5BE'],
                'data' => [($invoicesPartialPaid->count() / $invoices->count()) * 100]
            ],
            // الفواتير المدفوعة
            [
                "label" => "الفواتير المدفوعة",
                'backgroundColor' => ['#5D9C59'],
                'hoverBackgroundColor' => ['#4E6C50'],
                'data' => [($invoicesPaid->count() / $invoices->count()) * 100]
            ],
        ])
        ->options([]);
        // pie chart for invoices
        $pieChart = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 250])
        ->labels(["الفواتير الغير مدفوعة","الفواتير المدفوعة جزئيا","الفواتير المدفوعة"])
        ->datasets([
            [
                'backgroundColor' => ['#DF2E38', '#C7E8CA','#5D9C59'],
                'hoverBackgroundColor' => ['#820000','#B3E5BE', '#4E6C50'],
                'data' => [
                    ($invoicesUnpaid->count() / $invoices->count()) * 100,
                    ($invoicesPartialPaid->count() / $invoices->count()) * 100,
                    ($invoicesPaid->count() / $invoices->count()) * 100]
            ]
        ])
        ->options([]);
        return view('home', compact('BarChart','pieChart','invoices','invoicesUnpaid','invoicesPartialPaid','invoicesPaid'));
    }
}
