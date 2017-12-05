@extends('layouts.app')


@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Job Stock Query</h2>

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

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::text('job_order', null, array('placeholder' => 'Job Order','class' => 'form-control', 'id'=>'job_order')) !!}
            </div>

        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                {!! Form::text('cutomer_name', null, array('placeholder' => 'Customer Name','class' => 'form-control', 'id'=>'customer_name')) !!}
            </div>

            <div class="form-group">
              <select name="job_order_select" id="job_order_select" class="form-control">
              </select>
            </div>

        </div>

        <table class='table table-hover' id="table_items">
         <thead>
          <tr>
           <th>Item Code</th>
           <th>OK Quantity</th>
           <th>Damaged</th>
           <th>Missing</th>
          </tr>
         </thead>
         <tbody>
         </tbody>
        </table>


@endsection

@section('scripts')

    @include('includes.scripts.job_stock_query')

@endsection

