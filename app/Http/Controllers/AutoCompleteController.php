<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Location;
use App\Item;
use DB;

class AutoCompleteController extends Controller
{
   public function index(){
      return view('autocomplete.index');
   }

   public function searchCustomer(Request $request) {
        $query = $request->get('term','');

        $customers=Customer::where('company','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($customers as $customer) {
                $data[]=array(
                    'value'=>$customer->company,
                    'id'=>$customer->id,
                    'billing_address_line'=>$customer->billing_address_line,
                    'billing_address_city'=>$customer->billing_address_city,
                    'billing_address_pincode'=>$customer->billing_address_pincode
                );
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

   public function searchJobs(Request $request) {
        $query = $request->get('term','');

        $locations=Location::where('location_name', 'LIKE','%'.$query.'%')->where('type', 'job_order')->get();
        $data=array();
        foreach ($locations as $location) {
                $data[]=array(
                    'value'=>$location->location_name,
                    'id'=>$location->id,
                );
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

   public function searchItem(Request $request) {
        $query = $request->get('term','');

        $items=Item::where('name','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($items as $item) {
                $data[]=array('value'=>$item->name,'id'=>$item->id, 'code'=>$item->code);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

   public function getRequestedItem(Request $request) {
      $query = $request->keyword;
      $type = $request->type;
      $location = $request->godown;

      $items = DB::table('items as t1')
         ->select("t1.code", "t1.name","t1.rental_value", "t2.ok_quantity" )
         ->join("location_items AS t2", "t1.code", "=", "t2.item_code")
         ->where("t2.location_id", "=",$location)
         ->where("t1.name","LIKE","%".$query."%")
         ->get();

         $data = array();
         foreach ($items as $item) {
           $data[]=array(
                    'value'=>$item->name,
                    'id'=>$item->code,
                    'rental_value'=>$item->rental_value,
                    'aval_quantity'=>$item->ok_quantity
           );
         }

      if(count($data))
          return $data;
      else
          return ['value'=>'No Result Found','id'=>''];

   }

   public function expandBundle(Request $request) {
      $query = $request->keyword;
      $location = $request->location_id;

      $items = DB::table('items as t1')
         ->select("t1.code", "t1.name","t1.rental_value", "t3.quantity", "t2.ok_quantity" )
         ->join("bundle_items AS t3", "t1.code", "=", "t3.item_code")
         ->join("location_items AS t2", "t1.code", "=", "t2.item_code")
         ->where("t2.location_id", "=",$location)
         ->where("t3.bundle_code","=",$query)
         ->get();

      $data = array();
         foreach ($items as $item) {
           $data[]=array(
                    'name'=>$item->name,
                    'code'=>$item->code,
                    'rental_value'=>$item->rental_value,
                    'ok_quantity'=>$item->ok_quantity,
                    'quantity'=>$item->quantity
           );
         }
      if(count($data))
          return json_encode($data);
      else
          return ['value'=>'No Result Found','id'=>''];
    }

   public function getAvalItemQuantity(Request $request) {
      $query = $request->keyword;
      $location = $request->location_id;

      $items = DB::table('items as t1')
         ->select("t1.code", "t1.name","t1.rental_value", "t2.ok_quantity" )
         ->join("location_items AS t2", "t1.code", "=", "t2.item_code")
         ->where("t2.location_id", "=",$location)
         ->where("t1.code","=",$query)
         ->get();

      if(count($items))
          return json_encode($items);
      else
          return ['value'=>'No Result Found','id'=>''];
   }
}
