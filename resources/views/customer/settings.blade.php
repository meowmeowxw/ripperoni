@extends('layouts.app')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->getBags() as $error)
                @foreach ($error->getMessages() as $key => $message)
                    <li>{{$key}}: {{$message[0]}}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="card-title">{{__('User settings')}}</h4>
                <div class="card card-body">
                    <x-form.form action="{{route('customer.settings')}}" btntext="{{ __('Save') }}" btnaddclass="btn-lg btn-block"
                                 inputid="type-user" name="type" inputvalue="user">
                        <x-FormInput name="name" idAndFor="name" :lblName="__('Name')" inputValue="{{Auth::user()->name}}" type="text"/>
                        <x-FormInput name="email" idAndFor="email" :lblName="__('Email')" inputValue="{{Auth::user()->email}}" type="text"/>
                    </x-form.form>
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="card-title">{{__('Customer settings')}}</h4>
                <div class="card card-body">
                    <x-form.form action="{{route('customer.settings')}}" btntext="{{ __('Save') }}" btnaddclass="btn-lg btn-block"
                        inputid="type-customer" name="type" inputvalue="customer">
                        <x-FormInput name="credit_card" idAndFor="credit_card" :lblName="__('Credit Card')"
                                     inputValue="{{Auth::user()->customer->credit_card}}" errormessage=""
                                     errorname="credit_card" type="text"/>
                    </x-form.form>
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="card-title">{{__('Change password')}}</h4>
                <div class="card card-body">
                    <x-form.form action="{{route('password.change')}}" btntext="{{ __('Save') }}" btnaddclass="btn-lg btn-block">
                        <x-FormInput name="password" idAndFor="password" :lblName="__('Old Password')" type="password"/>
                        <x-FormInput name="new_password" idAndFor="new_password" :lblName="__('New Password')" type="password"/>
                        <x-FormInput name="new_password_confirmation" idAndFor="new_password_confirmation" :lblName="__('Confirm New Password')" type="password"/>
                    </x-form.form>
                </div>
            </div>
        </div>
    </div>
@endsection
