@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-body">
                    <x-form.form action="{{route('seller.settings')}}" enctype="multipart/form-data"
                                 btntext="{{ __('Save') }}" btnaddclass="btn-lg btn-block">
                        <x-FormInput name="name" idAndFor="name" :lblName="__('Name')" inputValue="{{Auth::user()->name}}" type="text"/>
                        <x-FormInput name="email" idAndFor="email" :lblName="__('Email')" inputValue="{{Auth::user()->email}}" type="text"/>
                        <x-FormInput name="company" idAndFor="company" :lblName="__('Company')" inputValue="{{Auth::user()->seller->company}}" type="text"/>
                        <x-FormInput name="credit_card" idAndFor="credit_card" :lblName="__('Credit Card')" inputValue="{{Auth::user()->seller->credit_card}}" type="text" />
                    </x-form.form>
                </div>
            </div>
        </div>
    </div>
@endsection
