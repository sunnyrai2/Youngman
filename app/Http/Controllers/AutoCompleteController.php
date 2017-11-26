<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
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

   public function searchItem(Request $request) {
        $query = $request->get('term','');

        $items=Item::where('name','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($items as $item) {
                $data[]=array('value'=>$item->name,'id'=>$item->id);
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
         ->where("t1.name","LIKE","%".$query."%%")
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
      return "Hello";
    }

   public function getAvalItemQuantity(Request $request) {
     return "Hello";
   }
}
