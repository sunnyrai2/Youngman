<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Challan;
use App\Order;
use App\Vendor;
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
      $name = Auth::user()->name;
      $warehouse = explode(" ", $name);
      $orders = array();
      $vendors = Vendor::where('type', 'Transporter')->get();

      $challans = DB::select("SELECT * FROM challans WHERE recieving IS NULL AND (pickup_location = ? OR delivery_location = ?)", [ $warehouse[0], $warehouse[0]  ]);

      foreach ($challans as $challan)
      {
        $orders[$challan->order_id] = Order::find($challan->order_id);
      }

      return view('movement.index')
        ->with('warehouse', $warehouse[0])
        ->with('challans', $challans)
        ->with('orders', $orders)
        ->with('vendors', $vendors);
    }

    public function addDeliveryRecieving(Request $request)
    {
      $this->validate($request, [

            'challanId' => 'required',
            'orderId' => 'required',
            'transporter' => 'required',
            'recieving_date' => 'required',
            'gr_no' => 'required',
            'amt' => 'required',
        ]);

      $challan_id = $request->input('challanId');

      $recieving_file_new_name = null;
      $uploadSuccess = false;

      if($request->hasFile('fileToUpload'))
      {
            $recieving_file           = $request->fileToUpload;  
            $original_name = $recieving_file->getClientOriginalName();
            $extension                = pathinfo($original_name, PATHINFO_EXTENSION);
            $recieving_file_new_name  = md5(time().$original_name).'.'.$extension;
            $uploadSuccess            = $recieving_file->move('uploads/recievings', $recieving_file_new_name);
      }

      if($uploadSuccess){
            //create journal entry simulated here by calling sleep
            sleep(5);

            $challan = Challan::find($challan_id);
                $challan->gr_no             = $request->input('gr_no');
                $challan->transporter       = $request->input('transporter');
                $challan->recieving_date    = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('recieving_date') )));
               // return $challan->recieving_date;
                $challan->recieving_amount  = $request->input('amt');
                $challan->recieving         = $recieving_file_new_name;
            $challan->save();
            $request->session()->flash('status', 'Task was successful!');
            return 'Task was successful';
      }
      else
      {
        return 'Failed to upload file';
      } 
    }
}
