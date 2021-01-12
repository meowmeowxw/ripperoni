@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    <x-slot name="title">
                        {{__('Customer settings')}}
                    </x-slot>
                    <x-form.form action="{{route('customer.cart.buy')}}" btntext="{{ __('Use these informations and buy products') }}"
                                 btnaddclass="btn-lg btn-block">
                        <x-FormInput name="credit_card" idAndFor="credit_card" :lblName="__('Credit Card')"
                                     inputValue="{{Auth::user()->customer->credit_card}}" type="text"/>
                        <x-FormInput name="street" idAndFor="street" :lblName="__('Street Address')"
                                     inputValue="{{Auth::user()->customer->street}}" type="text"/>
                        <x-FormInput name="city" idAndFor="city" :lblName="__('City')"
                                     inputValue="{{Auth::user()->customer->city}}" type="text"/>
                    </x-form.form>
                </x-card>
            </div>
        </div>
    </div>
@endsection
