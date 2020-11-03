<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use Carbon\Carbon;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        $totalInvoices = Invoice::count();
        $totalAmount = Invoice::sum('product_price');
        $totalDiscount = Invoice::select(DB::raw('round((discount/100 * product_price),2) as dis_val'))->pluck('dis_val')->sum();
        $totalBill = $totalAmount - $totalDiscount;

        return view('invoices.index',compact('invoices','totalInvoices','totalAmount','totalDiscount','totalBill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStoreRequest $request)
    {
        $data = [];
        $customer_name = $request->customer_name;
        $customer_email = $request->customer_email;
        $product_prices = $request->product_price;
        $discounts = $request->discount;
        $currentDT = Carbon::now();

        foreach($request->product_name as $key=>$val){            
            $data[] = ['customer_name'=>$customer_name,'customer_email'=>$customer_email,'product_name'=>$val,'product_price'=>$product_prices[$key],'discount'=>$discounts[$key],'created_at'=>$currentDT,'updated_at'=>$currentDT]; 
        }

        Invoice::insert($data);
        return json_encode(['message'=>'Invoice Stored Successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit',compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());
        return json_encode(['message'=>'Invoice Updated Successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
