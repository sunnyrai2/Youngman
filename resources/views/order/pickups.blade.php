@extends('layouts.app')


@section('content')

  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Pickup Coming Up</h2>
          </div>
      </div>
  </div>

  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
  @endif
<!-- Modal for manual Pickup -->
  <div class="modal fade" id="manual_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Add Pickup</h4>
        </div>
        <div class="modal-body">

          <form id="initiate_manual_pickup" method="post">
            <input type="hidden" id="type" name="type" value="initiate_manual_pickup" required="true">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label for="customer_name">Name</label>
              <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Name" autocomplete="off" required>
            </div>

            <div class="form-group">
              <select class="form-control job col-sm-4" name="job_order_id" id="job_order_select">        
                <option>Select</option>
              </select>
            </div>

            <div class="form-group">
              <label>Select Warehouse</label>
                <select class="form-control" name="warehouse">
                  <option>Select</option>
                  @foreach($godowns as $x => $x_value)
                    <option value="{{ $x }}">{{ $x_value }}</option>
                  @endforeach         
                </select>
            </div>

            <div class="form-group">
              <label for="pickup_date">New Pickup Date</label>
              <div class="input-group date">
              <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="pickup_date" class="form-control pull-right" id="pickup_date" required="true" >
              </div>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Add Pickup">

          </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Extend Order -->
  <div class="modal fade" id="extend_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Extend Order</h4>
        </div>
        <div class="modal-body">
          <form id="extend_order" method="post" enctype="multipart/form-data">
            <input type="hidden" id="type" name="type" value="extend_order" required="true">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label for="job_order">Job Order</label>
              <input class="form-control" type="text" id="job_order" name="job_order" value="" required="true" readonly="true">
               <input type="hidden" id="job_order_id" name="job_order_id" value="" required="true">
            </div>
            <div class="form-group">
              <label for="pickup_date">New Pickup Date</label>
              <input class="form-control" type="text" id="pickup_date" name="pickup_date" value="" required="true" >
            </div>
            <input type="file" name="fileToUpload" id="fileToUpload" required="true">
            <input type="submit" class="btn btn-primary" name="submit" value="Extend">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Pickup -->
  <div class="modal fade" id="pickup_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Pickup</h4>
        </div>
        <div class="modal-body">
          <form id="initiate_scheduled_pickup" method="post" enctype="multipart/form-data">
            <input type="hidden" id="type" name="type" value="initiate_scheduled_pickup" required="true">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label for="job_order">Job Order</label>
              <input class="form-control" type="text" id="job_order" name="job_order" value="" required="true" readonly="true">
               <input type="hidden" id="job_order_id" name="job_order_id" value="" required="true">
            </div>
            <div class="form-group">
              <label>Select Warehouse</label>
                <select class="form-control" name="warehouse">
                  <option>Select</option> 
                  @foreach($godowns as $x => $x_value)
                    <option value="{{ $x }}">{{ $x_value }}</option>
                  @endforeach  
                </select>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Pickup">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">  <a href="#manual_modal" class="btn btn-danger" data-toggle="modal">Pickup</a></div>

<table id="pickups_coming_up" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <th>Job Order</th>
    <th>Pickup Date</th>
    <th>Action</th>
    <th>Extend</th>
  </thead>
  <tbody>
    @foreach($pickupsComingUp as $pickup)
    <tr>
      <td>{{ $pickup->job_order }}</td>
      <td>{{ $pickup->pickup_date }}</td>
      <td><a href="#pickup_modal" class="btn btn-success" data-toggle="modal" data-job-order="{{ $pickup->job_order }}" data-job-order-id="{{ $pickup->id }}">Pickup</a></td>
      <td><a href="#extend_modal" class="btn btn-warning" data-toggle="modal" data-job-order="{{ $pickup->job_order }}" data-job-order-id="{{ $pickup->id }}">Pickup</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

@section('scripts')

    @include('includes.scripts.pickups')

@endsection