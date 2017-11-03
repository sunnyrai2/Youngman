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

                {!! Form::text('customer_id', null, array('placeholder' => 'Customer Id','class' => 'form-control')) !!}

            </div>

        </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">

                {!! Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_customer')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('customer_name', null, array('placeholder' => 'Customer Name','class' => 'form-control')) !!}

            </div>

        </div>

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

                {!! Form::text('billing_address_line', null, array('placeholder' => 'Billing Address','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('billing_address_city', null, array('placeholder' => 'Billing Address City','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::number('billing_address_pincode', null, array('placeholder' => 'Billing Address Pincode','class' => 'form-control')) !!}

            </div>

        </div>

         <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('delivery_address_line', null, array('placeholder' => 'Delivery Address','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('delivery_address_city', null, array('placeholder' => 'Delivery Address City','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::number('delivery_address_pincode', null, array('placeholder' => 'Delivery Address Pincode','class' => 'form-control')) !!}

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

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

             <button type="submit" class="btn btn-primary">Submit</button>

        </div>

  </div>

  {!! Form::close() !!}

@endsection

@section('scripts')

    @include('includes.scripts.datepicker')
    @include('includes.scripts.search_customer')

@endsection

