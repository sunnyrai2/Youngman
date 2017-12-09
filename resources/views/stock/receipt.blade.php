@extends('layouts.app')


@section('content')

  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Receipt of Goods</h2>
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

    {!! Form::open(array('method'=>'POST', 'id'=>'receipt_form')) !!}

               <div class="form-group">
                <label>Select Type</label>
                  <select class="form-control" name="type" id="type" required>
                    <option value="">Select</option>
                    <option value="1">Inter Company</option>
                    <option value="0">Out of Company</option>
                </select>
               </div>

                <div class="form-group" id="warehouselist">
                  <label>Select Pickup Warehouse</label>
                    <select class="form-control" name="pickup_godown_id" id="pickup_godown_id">
                      @foreach($godowns as $x => $x_value)
                        <option value="{{ $x }}">{{ $x_value }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group" id="supplierlist">
                  <label>Select Supplier</label>
                    <select class="form-control" name="supplier" id="supplier" required="true">
                      <option>Select</option>
                      @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->vendor_name }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label>Select Delivery Warehouse</label>
                    <select class="form-control" name="delivery_godown_id" id="delivery_godown_id">
                      @foreach($godowns as $x => $x_value)
                        <option value="{{ $x }}">{{ $x_value }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="panel-body ">
                  <table class="table  table-summary table-borderless " id="table_stock_adjust">
                      <thead>
                      <tr>
                          <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"></th>
                          <th>Item Id</th>
                          <th>Description</th>
                          <th>Unit Price</th>
                          <th>Quantity</th>
                          <th>Available Qty</th>
                          <th>Total</th>
                      </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
                  <button type="button" class="btn btn-success addmore">Add Row</button>
                  <button type="button" class="btn btn-danger delete">Delete Row</button>
                </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
             <button type="button" id="submit" class="btn btn-primary">Submit</button>
        </div>

  {!! Form::close() !!}


@endsection

@section('scripts')

   @include('includes.scripts.receipt_of_items')

@endsection

