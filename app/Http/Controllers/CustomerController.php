<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\QuickBookController;
use App\Customer;
use DB;


class CustomerController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $customers = Customer::orderBy('id','DESC')->paginate(10);

        return view('customer.index',compact('customers'))

            ->with('i', ($request->input('page', 1) - 1) * 10);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('customer.create');

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $this->validate($request, [

            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'credit_limit' => 'required',
            'billing_address_line' => 'required',
            'billing_address_city' => 'required',
            'billing_address_pincode' => 'required',
            'mailing_address_line' => 'required',
            'mailing_address_city' => 'required',
            'mailing_address_pincode' => 'required',
            'gstn' => 'required',
            'security_etter' => 'required',
            'rental_advance' => 'required',
            'rental_order' => 'required',
            'security_cheque' => 'required',


        ]);

        $request->security_etter =='on' ? $request->security_etter=1:$request->security_etter=0;


        Customer::create($request->all());


        return redirect()->route('customer.index')

                        ->with('success','Customer created successfully');

    }


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $customer = Customer::find($id);

        return view('customer.show',compact('customer'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $customer= Customer::find($id);

        return view('customer.edit',compact('customer'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',

        ]);

        Customer::find($id)->update($request->all());

        return redirect()->route('customer.index')
                        ->with('success','Customer updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->route('customer.index')

                        ->with('success','Customer deleted successfully');

    }

    public function getOrders(Request $request){
        $customer_id = $request->get('term','');
        $jobs = DB::select("SELECT orders.job_order FROM customers, quotations, orders WHERE quotations.id = orders.quotation_id AND customers.id = quotations.customer_id AND quotations.customer_id = ?", [$customer_id]);
        if(count($jobs))
             return $jobs;
        else
            return "No Result Found";
    }

}
