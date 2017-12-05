@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Movement {{ $warehouse }} </h2>

          </div>

      </div>

  </div>

  @if ($message = Session::get('success'))

    <div class="alert alert-success">

      <p>{{ $message }}</p>

    </div>
  @endif

    <div class="modal fade" id="modal-challan" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Recieving</h4>
        </div>
        <div class="modal-body">

          <form method="post" id="delivery_recieving" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="challan">Challan ID</label>
                  <input class="form-control" type="text" id="challan" name="challanId" value="" required="true" readonly>
                </div>
                <div class="form-group">
                  <label for="job_order">Job Order</label>
                  <input class="form-control" type="text" id="job_order" name="orderId" value="" required="true" readonly>
                </div>
                <div class="form-group">
                  <label for="fileToUpload">Recieving</label>
                  <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.jpg, .jpeg, .png, .gif" required="true">
                </div>
                <div class="form-group">
                  <label>Select Transporter</label>
                    <select class="form-control" name="transporter" id="transporter" required="true">
                      <option>Select</option>
                      @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="name">Recieving Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input class="form-control" name="recieving_date" data-inputmask="'alias': 'dd/mm/yyyy'" id="datemask" data-mask="" type="text" class="form-control pull-right">
                    </div>
                </div>
                <div class="form-group">
                  <label for="gr_no">LR No</label>
                  <input class="form-control" type="text" name="gr_no" id="gr_no" placeholder="LR Number" required="true">
                </div>
                <div class="form-group">
                  <label for="amt">Transport Amount</label>
                  <input class="form-control" type="text" name="amt" id="amt" placeholder="Transport Amount" required="true">
                </div>
                <input type="submit" name="submit" id="submit" value="Add Recieving">
          </form>
        </div>
        <div class="modal-footer">
           <div class="form-group">
                  <img id="loading" src="https://s-media-cache-ak0.pinimg.com/originals/f6/65/6a/f6656aa6fdb6b8f905dea0bcc2d71dd8.gif" width="100px" height="100px" hidden>
           </div>
        </div>
      </div>

    </div>
  </div>


  <table class="table table-bordered">

    <tr>

      <th>Type</th>

      <th>Challan No</th>

      <th>Delivery/Pickup Date</th>

      <th>Job Order</th>

      <th>View Challan</th>

      <th width="280px">Add Recieving</th>

    </tr>

    @foreach ($challans as $key => $challan)
    <?php $order = $orders[$challan->order_id]; ?>

    <tr>

      <td>{{ $challan->challan_type }}</td>

      <td>{{ $challan->id }}</td>

      <td></td>

      <td>{{ $order->job_order }}</td>

      <td> 
        @if ( $challan->challan_type === 'Delivery')
           <a class="btn btn-info" href="{{ route('challan.show',$challan->id) }}">Show</a> </td>
        @elseif ($challan->challan_type === 'Pickup')
           <a class="btn btn-info" href="{{ route('items_at_location', $challan->order_id ) }}" >Items</a> </td>
        @endif

      <td>
        @if ( $challan->challan_type === 'Delivery')
        <a href="#modal-challan" data-toggle="modal" class="btn btn-warning" data-challan-id="{{ $challan->id }}" data-job-order="{{ $order->job_order }}">Add Recieveing</a>
        @elseif ($challan->challan_type === 'Pickup')
           <a class="btn btn-info" >Pickup</a> 
        @endif
      </td>

    </tr>

    @endforeach

  </table>

@endsection

@section('scripts')

    @include('includes.scripts.delivery_recieving_form')

@endsection
