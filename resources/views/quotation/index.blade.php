@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Quotations</h2>

          </div>

          <div class="pull-right">

            @permission('quotation-create')

              <a class="btn btn-success" href="{{ route('quotation.create') }}"> Create New Quotation</a>

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

      <th>Name</th>

      <th width="280px">Action</th>

    </tr>

  @foreach ($quotations as $key => $quotation)

  <tr>

    <td>{{ ++$i }}</td>

    <td>{{ $quotation->site_name }}</td>


    <td>

      <a class="btn btn-info" href="{{ route('quotation.show',$quotation->id) }}">Show</a>

      @permission('quotation-edit')

      <a class="btn btn-primary" href="{{ route('quotation.edit',$quotation->id) }}">Edit</a>

      @endpermission

      @permission('order-create')

      <a class="btn btn-primary" href="{{ route('order.create',$quotation->id) }}">Create Order</a>

      @endpermission

      @permission('quotation-delete')

      {!! Form::open(['method' => 'DELETE','route' => ['quotation.destroy', $quotation->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

          {!! Form::close() !!}

          @endpermission

    </td>

  </tr>

  @endforeach

  </table>

  {!! $quotations->render() !!}

@endsection
