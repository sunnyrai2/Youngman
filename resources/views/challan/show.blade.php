@extends('layouts.app')

@section('content')

  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Challan {{ $challan->id }}</h2>
          </div>
      </div>
  </div>

  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>

    </div>

  @endif
<div clss="row">
    <div class="col-xs-12 table-responsive">
        <table style="width:100%" class="table table-bordered">
            <tr>
                <th>Youngman India Private Ltd</th>
                <th>Delivery Challan</th>
                <th>Original For Consignee</th>
            </tr>
            <tr>
                <td>{{ 'pickup_address' }}<br><b>GSTIN: </b>{{ 'our_gst' }}</td>
                <td><b>Challan No: </b>{{ 'challan_id' }}</td>
                <td><b> Date:</b> {{ 'date' }}</td>
            </tr>
            <tr>
                <td><b>Consignee Name & Address</b></td>
                <td rowspan="6" colspan="2">Remark:<br>{{ 'remarks' }}</td>
            </tr>
            <tr>
                <td>{{ 'delivery_address' }}</td>
            </tr>
            <tr>
                <td><b>Place Of Suppply: </b>{{ 'state_of_supply'}}</td>
            </tr>
        </table>
    </div>
</div>
<div clss="row">
    <table  class="table table-bordered table-striped">
      <thead>
        <th>S. No.</th>
        <th>HSN</th>
        <th>Item Id</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Unit</th>
        <th>Taxable Value</th>
        <th>CGST</th>
        <th>SGST</th>
        <th>IGST</th>
        <th>Central tax </th>
        <th>State tax </th>
        <th>Integrated tax </th>
        <th>Total</th>
      </thead>
      <tbody>
        @foreach($challan_items as $x => $challan_item)
        <tr>
          <td>
            {{ $x + 1 }}
          </td>
          <td>
            {{ $challan_item->HSN }}
          </td>
          <td>
            {{ $challan_item->code }}
          </td>
          <td>
            {{ $challan_item->name }}
          </td>
          <td>
            {{ $challan_item->ok_quantity }}
          </td>
          <td>
            Pcs
          </td>
          <td>
            {{ $challan_item->ok_quantity*$challan_item->unit_price }}
          </td>
          <td>
            @if($interstate)
              {{ 0 }}
            @else
              {{ $challan_item->CGST * 100 }} %
            @endif
          </td>
          <td>
            @if($interstate)
              {{ 0 }}
            @else
              {{ $challan_item->SGST * 100 }} %
            @endif
          </td>
          <td>
            @if($interstate)
              {{ 0 }}
            @else
              {{$challan_item->IGST * 100}} %
            @endif
          </td>
          <td>
            {{ $challan_item->ok_quantity * $challan_item->unit_price * $challan_item->CGST }}
          </td>
          <td>
            {{ $challan_item->ok_quantity * $challan_item->unit_price * $challan_item->SGST }}
          </td>
          <td>
            @if($interstate)
              {{ $challan_item->IGST * 100 }}
            @else
              {{ 0 }} %
            @endif
          </td>
          <td>
            {{ $challan_item->ok_quantity * $challan_item->unit_price * ($challan_item->SGST + $challan_item->CGST + 1) }}
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <th>Total</th>
          <th></th>
          <th></th>
          <th></th>
          <th>Total Qty</th>
          <th>Pcs</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th>Challan total</th>
      </tfoot>
    </table>
</div>

<h6 style="text-align:center;"><b>Using these items the following can be set up</b></h6>
<div class="row">
    <table  style="width:100%" class="table table-bordered table-striped">
        <thead>
            <th>Item id</th>
            <th>Quantity</th>
        </thead>
        <tbody>
            @foreach($challan_order_items as $x => $challan_order_item)
            <tr>
                <td>
                    {{ $challan_order_item->item_code}}
                </td>
                <td>
                    {{ $challan_order_item->ok_quantity }}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

@endsection
