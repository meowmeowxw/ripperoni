@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-seller-settings>
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
                    <x-slot name="company">
                        {{ $seller->company }}
                    </x-slot>
                    <x-slot name="credit_card">
                        {{ $seller->credit_card }}
                    </x-slot>
                </x-seller-settings>
            </div>
        </div>
    </div>
@endsection
