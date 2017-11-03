@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Customers CRUD</h2>

          </div>

          <div class="pull-right">

            @permission('customer-create')

              <a class="btn btn-success" href="{{ route('customer.create') }}"> Create New Customer</a>

              @endpermission

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

      <th>Title</th>

      <th>Description</th>

      <th width="280px">Action</th>

    </tr>

  @foreach ($customers as $key => $customer)

  <tr>

    <td>{{ ++$i }}</td>

    <td>{{ $customer->title }}</td>

    <td>{{ $customer->description }}</td>

    <td>

      <a class="btn btn-info" href="{{ route('customer.show',$customer->id) }}">Show</a>

      @permission('customer-edit')

      <a class="btn btn-primary" href="{{ route('customer.edit',$customer->id) }}">Edit</a>

      @endpermission

      @permission('customer-delete')

      {!! Form::open(['method' => 'DELETE','route' => ['customer.destroy', $customer->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

          {!! Form::close() !!}

          @endpermission

    </td>

  </tr>

  @endforeach

  </table>

  {!! $customers->render() !!}

@endsection
