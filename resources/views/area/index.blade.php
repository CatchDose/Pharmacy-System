@extends("layouts.app")

@section("title","Areas")

@section("style")

@endsection

@section("header","Areas")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">areas</a></li>

@endsection

@section("content")

    {{ $dataTable->table() }}

@endsection



@section('scripts')
    {{ $dataTable->scripts() }}
@endsection
