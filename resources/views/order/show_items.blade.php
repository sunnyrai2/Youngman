@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2> Items at {{ $location->location_name }}</h2>

          </div>

      </div>

  </div>

  <table class="table table-bordered">

    <tr>

      <th>Item Code</th>

      <th>Item Name</th>

      <th>Ok  Quantity</th>

      <th>Damaged Quantity</th>

      <th>Missing Quantity</th>

      <th>Last Updated</th>
    </tr>

    @foreach ($items as $key => $item)

    <tr>

      <td>{{ $item->item_code }}</td>

      <td>{{ $item->item_code }}</td>

      <td>{{ $item->ok_quantity }}</td>

      <td>{{ $item->damaged_quantity }}</td>

     <td>{{ $item->missing_quantity }}</td>

     <td>{{ $item->updated_at }}</td>

    </tr>

    @endforeach

  </table>

@endsection
