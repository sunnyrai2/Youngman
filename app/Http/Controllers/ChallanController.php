<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Quotation;
use App\Location;
use App\LocationItem;
use App\Item;
use App\Challan;
use App\ChallanItems;
use App\ChallanOrderItem;
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

        $order_challans = array();

        foreach ($orders as $order) {
          $order_challans[$order->id] = Order::find($order->id)->challans;
        }


        return view('challan.index',compact('orders','godowns','order_challans'))

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
        $item_feed = DB::select('select o.*, i.bundle 
          from order_item_feed as o, items as i 
          where o.job_order = ? and o.item_code = i.code', [$order->job_order]);

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
        $this->validate($request, [

            'itemNo' => 'required',
            'itemName' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'itemQtyBOM' => 'required',
            'itemCodeBOM' => 'required',
            'job_order' => 'required',
            'godown' => 'required',

        ]);

        DB::transaction(function($request) use ($request)
        {
            $godown = Location::where('id',$request->input('godown'))->pluck('location_name');
            $job_order_id = Order::where('job_order',$request->input('job_order'))->pluck('id');
            $order_location = Location::where('location_name', $request->input('job_order'))->pluck('id');

           //Create the challan
            $challan = Challan::create(
              [
                  'pickup_location'=>$godown[0],
                  'delivery_location'=>$request->input('job_order'),
                  'challan_type'=>'Delivery',
                  'order_id'=>$job_order_id[0],
                  'amount'=>array_sum($request->input('total'))
              ]);

            $challan_id = $challan->id;

            $item_name = $request->input('itemName');
            $item_code = $request->input('itemNo');
            $quantity = $request->input('quantity');
            $unit_price = $request->input('price');
            $total_price = $request->input('total');
            $item_code_BOM = $request->input('itemCodeBOM');
            $item_qty_BOM = $request->input('itemQtyBOM');

            $count = count($item_name);

            //Add items to challan
            for($i=0; $i<$count; $i++)
            {
                ChallanItems::create(
                    [
                        'status'=>0,
                        'challan_id'=>$challan_id,
                        'item_code'=>$item_code[$i],
                        'ok_quantity'=>$quantity[$i],
                        'unit_price'=>$unit_price[$i],
                        'total_price'=>$total_price[$i]
                    ]
                );

                //Add Items to Job Order Location
                DB::statement("INSERT INTO location_items (location_id, item_code, ok_quantity) VALUES  (?, ?, ?) ON DUPLICATE KEY UPDATE ok_quantity =( ok_quantity + VALUES(ok_quantity))", [$order_location[0], $item_code[$i], $quantity[$i]]);

                //Subtract Items from Godown
                DB::statement("INSERT INTO location_items (location_id, item_code, ok_quantity) VALUES  (?, ?, ?) ON DUPLICATE KEY UPDATE ok_quantity =( ok_quantity - VALUES(ok_quantity))",  [ $request->input('godown'), $item_code[$i], $quantity[$i]]);
            }

            $count = count($item_code_BOM);

            for($i=0; $i<$count; $i++)
            {
              //Add to Invoice Item feed
              DB::statement("INSERT INTO invoice_item_feed ( challan_id, job_order, item_code, quantity) VALUES ( ?, ?, ?, ? )", [ $challan_id, $request->input('job_order'), $item_code_BOM[$i], $item_qty_BOM[$i] ]);

              //Add to Challan Order Items
              DB::statement("INSERT INTO challan_order_item ( challan_id, item_code, ok_quantity) VALUES ( ?, ?, ? )", [ $challan_id, $item_code_BOM[$i], $item_qty_BOM[$i] ] );

              //Subtract from Order Item Feed
              DB::statement("UPDATE order_item_feed SET quantity = quantity - ? WHERE item_code = ? AND job_order = ?", [ $item_qty_BOM[$i], $item_code_BOM[$i], $request->input('job_order') ] );
            }
        });

        return redirect()->route('challan.index')

                        ->with('success','Challan created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $challan_id = $request->input('challan_id');

        $challan = Challan::find($challan_id);
        $challan_items = Challan::find($challan_id)->challanItems;
        $challan_order_items = Challan::find($challan_id)->challanOrderItems;
         return view('challan.show')
                  ->with('challan', $challan)
                  ->with('challan_items', $challan_items)
                  ->with('challan_order_items', $challan_order_items);

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
