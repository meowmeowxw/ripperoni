@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register Seller') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('seller.register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company name') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" required autocomplete="company" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="credit_card" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card') }}</label>

                                <div class="col-md-6">
                                    <input id="credit_card" type="text" class="form-control" name="credit_card" required autocomplete="credit_card">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
