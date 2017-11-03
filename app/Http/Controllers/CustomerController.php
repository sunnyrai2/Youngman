<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Customer;


class CustomerController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $customers = Customer::orderBy('id','DESC')->paginate(5);

        return view('customer.index',compact('customers'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

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

            'title' => 'required',

            'description' => 'required',

        ]);


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

        return view('Customer.edit',compact('customer'));

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

}
