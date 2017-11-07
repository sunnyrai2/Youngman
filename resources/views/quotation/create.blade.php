@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Create New Quotation</h2>

          </div>

          <div class="pull-right">

              <a class="btn btn-primary" href="{{ route('quotation.index') }}"> Back</a>

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

  {!! Form::open(array('route' => 'quotation.store','method'=>'POST')) !!}

  <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('customer_id', null, array('placeholder' => 'Customer Id','class' => 'form-control', 'id'=>'customer_id')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('customer_name', null, array('placeholder' => 'Customer Name','class' => 'form-control', 'id'=>'customer_name')) !!}

            </div>

        </div>

        <div id="suggesstion-box"></div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('contact_name', null, array('placeholder' => 'Contact Name','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('site_name', null, array('placeholder' => 'Site Name','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('billing_address_line', null, array('placeholder' => 'Billing Address','class' => 'form-control', 'id'=>'billing_address_line')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('billing_address_city', null, array('placeholder' => 'Billing Address City','class' => 'form-control', 'id'=>'billing_address_city')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::number('billing_address_pincode', null, array('placeholder' => 'Billing Address Pincode','class' => 'form-control', 'id'=>'billing_address_pincode')) !!}

            </div>

        </div>

         <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('delivery_address_line', null, array('placeholder' => 'Delivery Address','class' => 'form-control', 'id'=>'delivery_address_line')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('delivery_address_city', null, array('placeholder' => 'Delivery Address City','class' => 'form-control', 'id'=>'delivery_address_city')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::number('delivery_address_pincode', null, array('placeholder' => 'Delivery Address Pincode','class' => 'form-control', 'id'=>'delivery_address_pincode')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::date('delivery_date', null, array('placeholder' => 'Delivery Date','class' => 'form-control', 'id' => 'delivery_date')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {{ Form::text('pickup_date', '', array('placeholder' => 'Pickup Date', 'id' => 'pickup_date', 'class' => 'form-control')) }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

               {!! Form::date('security_amt', null, array('placeholder' => 'Security Amount','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <td><input type="text" name="item_code[]" placeholder="Item Code" class="form-control item_code" /></td>
                        <td><input type="text" name="item_name[]" placeholder="Item Name" class="form-control item_name" /></td>
                        <td><input type="text" name="unit_price[]" placeholder="Unit Price" class="form-control unit_price" /></td>
                        <td><input type="text" name="quantity[]" placeholder="Quantity" class="form-control quantity" /></td>
                    </tr>
                </table>
                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
            </div>
          </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
             <button type="submit" class="btn btn-primary">Submit</button>
        </div>

  </div>

  {!! Form::close() !!}

@endsection

@section('scripts')

    @include('includes.scripts.datepicker')
    @include('includes.scripts.search_customer')
    @include('includes.scripts.add_more_items')

@endsection

