@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Client') }}</div>
                        <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form method="post"
                            action="{{ url('/clients/' . $client->id . '/update') }}">
                            @csrf
                            <input type="hidden" name="client_id" value="{{ $client->id }}" />
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" id="first-name" name="first_name" value="{{ $client->first_name }}" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last-name" name="last_name" value="{{ $client->last_name }}" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $client->email }}">
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="{{ $client->phone }}">
                                @if($errors->has('phone'))
                                    <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>

                            <div class="card-header">{{ __('Cash loan application') }}</div>

                            <div class="form-group">
                                <label for="loan-amount">Loan amount</label>
                                <input type="text" id="loan-amount" name="loan_amount" class="form-control" value="{{ $client->cashLoans->first()->loan_amount ?? 0 }}">
                            </div>

                            <div class="card-header">{{ __('Home loan application') }}</div>

                            <div class="form-group">
                                <label for="property-value">Property value</label>
                                <input type="text" id="property-value" name="property_value" class="form-control" value="{{ $client->homeLoans->first()->property_value ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="down-payment-amount">Down payment amount</label>
                                <input type="text" id="down-payment-amount" name="down_payment_amount" class="form-control" value="{{ $client->homeLoans->first()->down_payment_amount ?? 0 }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
