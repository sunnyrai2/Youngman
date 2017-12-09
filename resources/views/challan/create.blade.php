@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h3>Creating challan for {{ $order->job_order }}</h3>
              <h4>Godown <p id="godown_name">{{ $_GET['godown_id'] }}</p></h4>

          </div>

      </div>

  </div>

  @if ($message = Session::get('success'))

    <div class="alert alert-success">

      <p>{{ $message }}</p>

    </div>

  @endif

  <div class="modal modal-danger" id="verify" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <input type="text" name="password" id="password">
                <button type="submit" name="verify_pass" class="btn btn-primary" data-dismiss="modal" onclick="verifyUser(this.form.password);">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
  </div>

 {!! Form::open(array('route' => 'challan.store','method'=>'POST')) !!}

<div class="col-sm-8">
  <div class="panel panel-default">
    <div class="panel-heading">Current Challan</div>
      <div class="panel-body ">
  
        <table class="table  table-summary table-borderless " id="table_challan_rental">
            <thead>
            <tr>
                <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"></th>
                <th>Item Id</th>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Available Qty</th>
                <th>Total</th>
            </tr>
           </thead>
           <tbody>
           </tbody>
        </table>

        <button type="button" class="btn btn-success addmore">Add Row</button>
        <button type="button" class="btn btn-danger delete">Delete Row</button>
        
        </div>
  </div>
  <button class="btn btn-primary" onclick="confirm('Are you sure?')">Submit</button>
</div>


<div class="col-sm-4">
  <div class="panel panel-default">
      <div class="panel-heading">Material to be sent</div>
      <div class="panel-body ">
        <table class="table table-condensed table-summary table-borderless " id="required_items">
            <tbody>
           <tr>
                <th>Item Code</th>
                <th>Quantity</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            @foreach ($item_feed as $item)
              <tr id="{{ $item->item_code }}">
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->bundle ? 'Bundle':'Item' }}</td>
                <td><button type="button" class="btnSelect btn-primary">Add</button></td>
              </tr>
            @endforeach
           </tbody>
        </table>

    </div>
  </div>

  <div class="panel panel-default">
      <div class="panel-heading">Material fullfilled by present BOM</div>
      <div class="panel-body ">
        <table class="table table-condensed table-summary table-borderless " id="fullfilled_items">
            <thead>
           <tr>
                <th>Item Code</th>
                <th>Quantity</th>
            </tr>
           
           </thead>
           <tbody></tbody>
        </table>

    </div>
  </div>

</div>

{!! Form::hidden('job_order', $order->job_order ) !!}
{!! Form::hidden('godown',  $_GET['godown_id'] ) !!}

{!! Form::close() !!}

@endsection

@section('scripts')

    @include('includes.scripts.challan_create')

@endsection
