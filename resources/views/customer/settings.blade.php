@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-customer-settings>
                    <x-slot name="title">
                        {{ __('Settings') }}
                    </x-slot>
                    <x-slot name="id">
                        {{ Auth::user()->id }}
                    </x-slot>
                    <x-slot name="name">
                        {{ Auth::user()->name }}
                    </x-slot>
                    <x-slot name="email">
                        {{ Auth::user()->email }}
                    </x-slot>
                </x-customer-settings>
            </div>
        </div>
    </div>
@endsection
