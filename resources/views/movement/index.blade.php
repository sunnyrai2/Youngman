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

  @foreach ($challans as $key => $challan)

  @if($challan->challan_type === 'Delivery')

    <div class="modal fade" id="modal-challan-{{ $challan->id }}" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Recieving for Challan {{ $challan->id }}</h4>
        </div>
        <div class="modal-body">

          <form id="form" action="" method="post">
          <h1>Displaying Progress Bar on Form Submission</h1>
          <label>Student Name :</label>
          <input type="text" name="dname" id="name"/>
          <label>Student Email :</label>
          <input type="text" name="demail" id="email"/>
          <label>Student Mobile No. :</label>
          <input type="text" name="dmobile" id="mobile"/>
          <label>Student Address :</label><br />
          <input type="text" name="daddress" id="address"/>
          <img id="loading" src="images/3.gif" /> <!-- Loading Image -->
          <input type="button" id="submit" name="submit" value="Submit" />
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  @endif

@endforeach


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
         <a class="btn btn-info" >Items</a> </td>
      @endif

    <td>
      @if ( $challan->challan_type === 'Delivery')
         <a class="btn btn-warning" role="button" data-toggle="modal" data-target="#modal-challan-{{ $challan->id }}">Add Recieving</a>
      @elseif ($challan->challan_type === 'Pickup')
         <a class="btn btn-info" >Items</a> </td>
      @endif
    </td>

  </tr>

  @endforeach

  </table>

@endsection
