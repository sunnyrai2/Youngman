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


  <table class="table table-bordered">

    <tr>

      <th>No</th>

      <th>Type</th>

      <th>Job Order</th>

       <th width="280px">Challans</th>

      <th>View Challan</th>

      <th width="280px">Add Recieving</th>

    </tr>

  @foreach ($challans as $key => $challan)
  <?php $order = $orders[$challan->order_id]; ?>

  <tr>

    <td>{{ $key }}</td>

    <td>{{ $order->challan_type }}</td>

    <td>{{ $order->job_order }}</td>

    <td> </td>

    <td> <a class="btn btn-info" href="{{ route('challan.show',$challan->id) }}">Show</a> </td>


    <td>    </td>

  </tr>

  @endforeach

  </table>

@endsection
