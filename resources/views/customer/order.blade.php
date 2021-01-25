@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-8 col-xl-7" style="max-width: 768px;">
            <x-order :order="$order"/>
        </div>
    </div>
@endsection
