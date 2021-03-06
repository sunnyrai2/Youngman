<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Location;
use App\LocationItem;
use DB;


class ItemCRUD2Controller extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)

    {

        $items = Item::orderBy('id','DESC')->paginate(10);

        return view('ItemCRUD2.index',compact('items'))

            ->with('i', ($request->input('page', 1) - 1) * 10);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('ItemCRUD2.create');

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

            'title' => 'required',

            'description' => 'required',

        ]);


        Item::create($request->all());


        return redirect()->route('itemCRUD2.index')

                        ->with('success','Item created successfully');

    }


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $item = Item::find($id);

        return view('ItemCRUD2.show',compact('item'));

    }

    /**

     * Display the item present at which locations
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showItemAtGodowns(Request $request)
    {
      $item_code = $request->get('term','');
      $items = DB::select("SELECT r.location_id, r.ok_quantity, r.damaged_quantity, r.missing_quantity FROM location_items AS r, locations AS l WHERE l.type = 'godown' AND r.location_id = l.id AND r.item_code = ?", [ $item_code ]);

      return $items;
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $item = Item::find($id);

        return view('ItemCRUD2.edit',compact('item'));

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

        $this->validate($request, [

            'title' => 'required',

            'description' => 'required',

        ]);


        Item::find($id)->update($request->all());


        return redirect()->route('itemCRUD2.index')

                        ->with('success','Item updated successfully');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        Item::find($id)->delete();

        return redirect()->route('itemCRUD2.index')

                        ->with('success','Item deleted successfully');

    }

}
