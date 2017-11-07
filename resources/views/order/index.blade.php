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

  <table class="table table-bordered">

    <tr>

      <th>No</th>

      <th>Job Order</th>

      <th width="280px">Action</th>

    </tr>

  @foreach ($orders as $key => $order)

  <tr>

    <td>{{ ++$i }}</td>

    <td>{{ $order->job_order }}</td>


    <td>

      <a class="btn btn-info" href="{{ route('order.show',$order->id) }}">Show</a>

      @permission('order-edit')

      <a class="btn btn-primary" href="{{ route('order.edit',$order->id) }}">Edit</a>

      @endpermission

      @permission('order-delete')

      {!! Form::open(['method' => 'DELETE','route' => ['order.destroy', $order->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

          {!! Form::close() !!}

          @endpermission

    </td>

  </tr>

  @endforeach

  </table>

  {!! $orders->render() !!}

@endsection
