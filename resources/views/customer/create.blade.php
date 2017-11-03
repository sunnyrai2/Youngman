@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Create New Customer</h2>

          </div>

          <div class="pull-right">

              <a class="btn btn-primary" href="{{ route('customer.index') }}"> Back</a>

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

  {!! Form::open(array('route' => 'customer.store','method'=>'POST')) !!}

  <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('company', null, array('placeholder' => 'Company','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::number('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('credit_limit', null, array('placeholder' => 'Credit Limit','class' => 'form-control')) !!}

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

                {!! Form::text('mailing_address_line', null, array('placeholder' => 'MailingAddress','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('mailing_address_city', null, array('placeholder' => 'Mailing Address City','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::number('mailing_address_pincode', null, array('placeholder' => 'Mailing Address Pincode','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('gstn', null, array('placeholder' => 'GSTN','class' => 'form-control')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::checkbox('security_etter', null, array('value' => 'true','class' => 'form-control')) !!}
                Security Letter
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::checkbox('rental_advance', null, array('value' => 'true','class' => 'form-control')) !!}
                Rental Advance
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::checkbox('rental_order', null, array('true','class' => 'form-control')) !!}
                Rental Order
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::checkbox('security_cheque', null, array('true','class' => 'form-control')) !!}
                Security Cheque
            </div>

        </div>




        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

             <button type="submit" class="btn btn-primary">Submit</button>

        </div>

  </div>

  {!! Form::close() !!}

@endsection
