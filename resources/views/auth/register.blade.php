@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-card>
                    <x-slot name="title">
                        {{ __('Register') }}
                    </x-slot>
                    <x-form.form action="{{ route('register') }}" btntext="{{ __('Register') }}"
                                 btnaddclass="btn-block">
                        <x-FormInput name="name" idAndFor="name" :lblName="__('Name')" type="text"
                                     :value="old('name')"/>
                        <x-FormInput name="email" idAndFor="email" :lblName="__('E-mail Address')" type="email"/>
                        <x-FormInput name="password" idAndFor="password" :lblName="__('Password')" type="password"/>
                        <label for="password-confirm"
                               class="">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control mb-2"
                               name="password_confirmation" required autocomplete="new-password"
                               placeholder="{{__('Confirm Password')}}">
                        <x-formInput name="credit_card" idAndFor="credit_card" :lblName="__('Credit Card')" type="numeric"/>
                        <x-formInput name="street" idAndFor="street" :lblName="__('Street Address')" type="text"/>
                        <x-formInput name="city" idAndFor="city" :lblName="__('City')" type="text"/>
                    </x-form.form>
                </x-card>
            </div>
        </div>
    </div>
@endsection
