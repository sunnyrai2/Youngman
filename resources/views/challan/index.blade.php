@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Orders</h2>

          </div>

      </div>

  </div>

  @if ($message = Session::get('success'))

    <div class="alert alert-success">

      <p>{{ $message }}</p>

    </div>

  @endif

 @foreach ($orders as $key => $order)

  @if($order->godown_id === null)

    <div class="modal fade" id="modal-godown-{{ $order->id }}" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Service Godown for {{ $order->job_order }}</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['method' => 'GET','route' => ['order.godown', $order->id],'style'=>'display:inline']) !!}
          <div class="form-group">
            {!! Form::Label('godowns', 'Godown:') !!}
            <select class="form-control" name="godown_id">
              @foreach($godowns as $x => $x_value)
                <option value="{{ $x }}">{{ $x_value }}</option>
              @endforeach
            </select>
          </div>
          {!! Form::submit('Add Godown!'); !!}
          {!! Form::close() !!}
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

      <th>No</th>

      <th>Job Order</th>

       <th width="280px">Challans</th>

      <th>View Order</th>

      <th width="280px">Create Challan</th>

    </tr>

  @foreach ($orders as $key => $order)

  <tr>

    <td>{{ ++$i }}</td>

    <td>{{ $order->job_order }}</td>

    <td> View Challan</td>

    <td> <a class="btn btn-info" href="{{ route('order.show',$order->id) }}">Show</a> </td>


    <td>



      @permission('challan-create')

      @if($order->godown_id === null)

    <a class="btn btn-success" role="button" data-toggle="modal" data-target="#modal-godown-{{ $order->id }}">Add Godown

      @else

      <a class="btn btn-success" href="{{ route('challan.create',$order->id) }}">Create</a>

      @endif

      @endpermission

    </td>

  </tr>

  @endforeach

  </table>

  {!! $orders->render() !!}

@endsection
