@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h3>Creating challan for {{ $order->job_order }}</h3>
              <h4>Godown </h4>

          </div>

      </div>

  </div>

  @if ($message = Session::get('success'))

    <div class="alert alert-success">

      <p>{{ $message }}</p>

    </div>

  @endif

<div class="col-sm-8">

  <div class="panel panel-default">
    <div class="panel-heading">Current Challan</div>
      <div class="panel-body ">
  
        <table class="table  table-summary table-borderless ">
            <tbody>
            <tr>
                <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"></th>
                <th>Item Id</th>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Available Qty</th>
                <th>Total</th>
            </tr>
            
           </tbody>
        </table>

        <button class="btn btn-success">Add Row</button>
        <button class="btn btn-danger">Delete Row</button>
        
        </div>
  </div>
  <button class="btn btn-primary" onclick="confirm('Are you sure?')">Submit</button>
</div>


<div class="col-sm-4">
  <div class="panel panel-default">
      <div class="panel-heading">Material to be sent</div>
      <div class="panel-body ">
        <table class="table table-condensed table-summary table-borderless ">
            <tbody>
           <tr>
                <th>Item Code</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            @foreach ($item_feed as $item)
              <tr>
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->quantity }}</td>
                <td><button>Add</button></td>
              </tr>
            @endforeach
           </tbody>
        </table>

    </div>
  </div>

  <div class="panel panel-default">
      <div class="panel-heading">Material fullfilled by present BOM</div>
      <div class="panel-body ">
        <table class="table table-condensed table-summary table-borderless ">
            <tbody>
           <tr>
                <th>Item Code</th>
                <th>Quantity</th>
            </tr>
           
           </tbody>
        </table>

    </div>
  </div>

</div>


  


@endsection
