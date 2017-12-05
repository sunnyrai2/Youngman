<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Location;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recieptOfGoods()
    {
         $godowns = Location::where('type','godown')->orderBy('id','DESC')->pluck('location_name','id');
         $suppliers = Vendor::where('type', 'Supplier')->get();

         return view('stock.receipt')
          ->with('godowns', $godowns)
          ->with('suppliers', $suppliers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saleOfGoods()
    {
         $godowns = Location::where('type','godown')->orderBy('id','DESC')->pluck('location_name','id');
         $buyers = Vendor::where('type', 'Sale')->get();

         return view('stock.sale')
          ->with('godowns', $godowns)
          ->with('buyers', $buyers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockQuery()
    {
         return view('stock.query');
    }

    /**
     * Return the page to display the stock of selected job order
     *
     * @return \Illuminate\Http\Response
     */
    public function jobStock()
    {
        return view('stock.job_stock');
    }

}
