@extends('layouts.app')

@section('content')

  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Items</h2>
          </div>

          <div class="pull-right">
            @permission('item-create')
              <a class="btn btn-success" href="{{ route('itemCRUD2.create') }}"> Create New Item</a>
            @endpermission
          </div>

      </div>

  </div>

  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
  @endif

  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <th>No</th>
      <th>Title</th>
      <th>Description</th>
      <th width="280px">Action</th>
    </thead>
    <tbody>
      @foreach ($items as $key => $item)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $item->title }}</td>
          <td>{{ $item->description }}</td>
          <td>
              <a class="btn btn-info" href="{{ route('itemCRUD2.show',$item->id) }}">Show</a>
            @permission('item-edit')
              <a class="btn btn-primary" href="{{ route('itemCRUD2.edit',$item->id) }}">Edit</a>
            @endpermission
            @permission('item-delete')
              {!! Form::open(['method' => 'DELETE','route' => ['itemCRUD2.destroy', $item->id],'style'=>'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            @endpermission
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {!! $items->render() !!}

@endsection
