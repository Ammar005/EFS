<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use App\Stock;
use App\Investment;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        //
        $customers=Customer::all();
        return view('customers.index',compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $stocks= Stock::where('customer_id', $id)->get();
        $investments= Investment::where('customer_id',$id)->get();

        $StockTotal= Stock::select(DB::raw('sum(purchase_price) as price_total'))->first();
        $InvestmentTotal= Investment::select(DB::raw('sum(Acquired_Value) as Investment.total_investment'))->first();

        return view('customers.show',compact('customer', 'stocks','investments','StockTotal', 'InvestmentTotal'));
    }


    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $customer= new Customer($request->all());
        $customer->save();
        return redirect('customers');
    }

    public function edit($id)
    {
        $customer=Customer::find($id);
        return view('customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        //
        $customer= new Customer($request->all());
        $customer=Customer::find($id);
        $customer->update($request->all());
        return redirect('customers');
    }

    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect('customers');
    }

    public function stringify($id)
    {
        // $customer=Customer::where('id', $id)->select('customer_id','name','address','city','state','zip','home_phone','cell_phone')->first();
        $customer = Customer::where('cust_number', $id)->select('cust_number','name','address','city','state','zip','home_phone','cell_phone')->first();

        $customer = $customer->toArray();
        return response()->json($customer);
    }



}

