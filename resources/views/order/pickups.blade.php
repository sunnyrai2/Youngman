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
