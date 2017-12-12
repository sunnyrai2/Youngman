@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Challan {{ $challan->id }}</h2>

          </div>

      </div>

  </div>

  @if ($message = Session::get('success'))

    <div class="alert alert-success">

      <p>{{ $message }}</p>

        
    </div>

  @endif
  Challan
  {{ $challan }}
  Challan Items
  {{ $challan_items }}

  Challan Order Items
  {{ $challan_order_items }}


@endsection
