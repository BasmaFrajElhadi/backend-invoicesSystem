<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = section::all();
        $products = Products::all();
        return view('pages.products.products',compact('products','sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Products::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        return redirect()->back()->with("successful","تم الاضافة بنجاح ");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
        $id = section::where('section_name', $request->section_name)->first()->id;
        Products::where('id', $request->pro_id)->update([
            'product_name' => $request->product_name,
            'section_id' => $id,
            'description' => $request->description,
        ]);

        return redirect()->back()->with("successful","تم التعديل بنجاح ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Products::where('id', $request->pro_id)->delete();
        return redirect()->back()->with("successful","تم الحذف بنجاح");
    }
}
