@extends('layouts.app')

@section('content')
    <li>{{$product->name}}</li>
    <li>{{$seller->company}}</li>
    <li>{{$category->name}}</li>
@endsection
