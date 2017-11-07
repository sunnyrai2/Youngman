<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Order;

use App\Quotation;

use App\State;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::orderBy('id','DESC')->paginate(5);

        return view('order.index',compact('orders'))

            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('order.create')->with('quotation', Quotation::find($id))
                                   ->with('states', State::all());    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           // 'quotation_id'=>'required',
            'po_no'=>'required',
            'place_of_supply'=>'required',
        ]);

        $order = new Order;



        if($request->hasFile('security_etter')){
            $security_etter = $request->security_etter;
            $security_etter_new_name = time().$security_etter->getClientOriginalName();
            $security_etter->move('uploads/order_attach', $security_etter_new_name);
        }

        if($request->hasFile('rental_advance')){
            $rental_advance = $request->rental_advance;
            $rental_advance_new_name = time().$rental_advance->getClientOriginalName();
            $rental_advance->move('uploads/order_attach', $rental_advance_new_name);
        }

        if($request->hasFile('rental_order')){
            $rental_order = $request->rental_order;
            $rental_order_new_name = time().$rental_order->getClientOriginalName();
            $rental_order->move('uploads/order_attach', $rental_order_new_name);
        }

        if($request->hasFile('security_cheque')){
            $security_cheque = $request->security_cheque;
            $security_cheque_new_name = time().$security_cheque->getClientOriginalName();
            $security_cheque->move('uploads/order_attach', $security_cheque_new_name);
        }

        //Upload to quickbooks

        $order = Order::create([
             'quotation_id' => $request->quotation_id,
             'quickbooks_id'=> $quickbooks_id,
             'job_order' => $job_order,
             'po_no' =>$request->po_no,
             'place_of_supply' => $request->place_of_supply,
             'security_etter' => 'uploads/order_attach' . $security_etter_new_name,
             'rental_advance' => 'uploads/order_attach' . $rental_advance_new_name,
             'rental_order' => 'uploads/order_attach' . $rental_order_new_name,
             'security_cheque' => 'uploads/order_attach' . $security_cheque
        ]);




        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
