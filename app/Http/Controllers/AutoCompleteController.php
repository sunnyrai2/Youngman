<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Item;

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
                $data[]=array('value'=>$customer->company,'id'=>$customer->id);
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
}
