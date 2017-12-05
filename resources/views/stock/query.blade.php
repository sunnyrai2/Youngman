@extends('layouts.app')


@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Stock Query</h2>

          </div>

      </div>

  </div>

  @if (count($errors) > 0)

    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

  @endif

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {!! Form::text('item_name', null, array('placeholder' => 'Item Name','class' => 'form-control', 'id'=>'item_name')) !!}
            </div>

        </div>

        <table class='table table-hover'>
         <thead>
          <tr>
           <th>Warehouse</th>
           <th>Quantity</th>
           <th>Damaged</th>
          </tr>
         </thead>
         <tbody>
          TODO display the recieved data in this table
         </tbody>
        </table>


@endsection

@section('scripts')

    @include('includes.scripts.stock_query')

@endsection

