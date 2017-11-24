@extends('layouts.app')



@section('content')

  <div class="row">

      <div class="col-lg-12 margin-tb">

          <div class="pull-left">

              <h2>Create New Order</h2>

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

  {!! Form::open(array('route' => 'order.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}

  <div class="row">

        <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('customer_id', null, array('placeholder' => 'Customer Id','class' => 'form-control', 'id'=>'customer_id')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::text('po_no', null, array('placeholder' => 'PO Number','class' => 'form-control', 'id'=>'po_no')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                {!! Form::number('security_amt', null, array('placeholder' => 'Security Amount','class' => 'form-control', 'id'=>'security_amt')) !!}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <select name="place_of_supply" class="form-control">
                  @foreach($states as $state)
                    <option value="{{$state->state_code}}">{{ $state->state_name}}</option>
                  @endforeach
              </select>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <label for="security_etter">Security Letter</label>
              <input type="file" name="security_etter" class="form-group">
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <label for="rental_advance">Rental Advance</label>
              <input type="file" name="rental_advance" class="form-group">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <label for="srental_order">Rental Order</label>
              <input type="file" name="rental_order" class="form-group">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <label for="security_cheque">Security Cheque</label>
              <input type="file" name="security_cheque" class="form-group"></input>

            </div>

        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
             <button type="submit" class="btn btn-primary">Submit</button>
        </div>

  </div>

  {!! Form::close() !!}

@endsection

