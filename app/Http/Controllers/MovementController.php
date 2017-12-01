<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Challan;
use App\Order;
use Auth;
use DB;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$orders = Order::orderBy('id','DESC')->paginate(5);

        //return view('order.index',compact('orders'))

          //  ->with('i', ($request->input('page', 1) - 1) * 5);

      $qbo_obj = new \App\Http\Controllers\QuickBookController();
      $qbo_connect = $qbo_obj->qboConnect();

      dd($qbo_connect);
      $name = Auth::user()->name;
      $warehouse = explode(" ", $name);
      $orders = array();

      $challans = DB::select("SELECT * FROM challans WHERE pickup_location = ? OR delivery_location = ?", [ $warehouse[0], $warehouse[0]  ]);

      foreach ($challans as $challan) {
          $orders[$challan->order_id] = Order::find($challan->order_id);
        }

      return view('movement.index')
        ->with('warehouse', $warehouse[0])
        ->with('challans', $challans)
        ->with('orders', $orders);
    }
}
