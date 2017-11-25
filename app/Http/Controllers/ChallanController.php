<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Quotation;
use App\Location;
use App\Item;
use DB;

class ChallanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $orders = Order::orderBy('id','DESC')->paginate(5);

         $godowns = Location::where('type','godown')->orderBy('id','DESC')->pluck('location_name','id');

        return view('challan.index',compact('orders','godowns'))

            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $order = Order::find($id);
        $quotation = Quotation::find($order->quotation_id);
        $item_feed = DB::select('select * from order_item_feed where job_order = ?', [$order->job_order]);

        return view('challan.create')
          ->with('order', $order)
          ->with('quotation', $quotation)
          ->with('item_feed', $item_feed);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
