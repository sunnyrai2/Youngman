<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Order;

use App\Quotation;

use App\State;

use App\Location;

use DB;

use App\Http\Controllers\QuickBookController;

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

        $security_etter_new_name = null;
        $rental_advance_new_name = null;
        $rental_order_new_name = null;
        $security_cheque_new_name = null;

        $job_order = "Job/".rand(1,100);

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


        $quickbooks_controller = new QuickBookController();
        $quickbooks_id = $quickbooks_controller->createOrder($request);


        $order = new Order();
        $order->quickbooks_id = $quickbooks_id;
        $order->job_order = $job_order;
        $order->po_no = $request->po_no;
        $order->place_of_supply = $request->place_of_supply;
        $order->security_etter =  $security_etter_new_name;
        $order->rental_advance = $rental_advance_new_name;
        $order->rental_order = $rental_order_new_name;
        $order->security_cheque = $security_cheque_new_name;



        $quotation = Quotation::find($request->quotation_id);

        $quotation->order()->save($order);

         Location::create(
                    [
                        'location_name'=>$job_order,
                        'type'=>'job_order',
                        'state_code'=>$request->place_of_supply,
                    ]
                );

         DB::table('quotations')
            ->where('id', $request->quotation_id)
            ->update([
                'converted_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                ]);



        return redirect()->route('order.index')

                        ->with('success','Order created successfully');
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
    public function godown(Request $request, $id)
    {
        $this->validate($request, [

            'godown_id' => 'required',

        ]);

        DB::table('orders')
            ->where('id', $id)
            ->update(array('godown_id' => $request->godown_id));

        return redirect()->route('challan.index')

                        ->with('success','Godown added successfully');
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
