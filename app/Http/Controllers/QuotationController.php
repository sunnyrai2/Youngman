<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Quotation;
use App\QuotationItems;

use Auth;
use DB;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $quotations = Quotation::orderBy('id','DESC')->paginate(5);

        return view('quotation.index',compact('quotations'))

            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotation.create');
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

            'customer_id' => 'required',
            'contact_name' => 'required',
            'site_name' => 'required',
            'billing_address_line' => 'required',
            'billing_address_city' => 'required',
            'billing_address_pincode' => 'required',
            'security_amt' => 'required',

        ]);

        $user = Auth::user();

        $request->request->set('created_by', $user->id);
        $request->request->set('total', 0);
        $request->request->set('freight', 0);
        $request->request->set('delivery_date', date("Y-m-d", strtotime($request->delivery_date)));
        $request->request->set('pickup_date', date("Y-m-d", strtotime($request->pickup_date)));

        DB::transaction(function($request) use ($request)
        {
            $quotation = Quotation::create($request->all());

            $quotation_id = $quotation->id;

            $item_name = $request->input('item_name');
            $item_code = $request->input('item_code');
            $quantity = $request->input('quantity');
            $unit_price = $request->input('unit_price');

            $count = count($item_name);

            for($i=0; $i<$count; $i++){
                QuotationItems::create(
                    [
                        'quotation_id'=>$quotation_id,
                        'item_code'=>$item_code[$i],
                        'unit_price'=>$unit_price[$i],
                        'quantity'=>$quantity[$i]
                    ]
                );
            }
        });

        return redirect()->route('quotation.index')

                        ->with('success','Quotation created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotation = Quotation::find($id);

        return view('quotation.show',compact('quotation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotation= Customer::find($id);

        return view('quotation.edit',compact('quotation'));
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
        Quotation::find($id)->delete();

        return redirect()->route('quotation.index')

                        ->with('success','Quotation deleted successfully');
    }
}
