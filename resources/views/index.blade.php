@extends("layouts.app")

@section("title","Home")

@section("style")

@endsection

@section("header","Home page")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Home</a></li>

@endsection

@section("content")
    <h1>Pharmacy System {{auth()->user()->name}}</h1>
@endsection

@section("script")

@endsection
