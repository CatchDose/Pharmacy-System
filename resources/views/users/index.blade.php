@extends("layouts.app")

@section("title","Users")

@section("style")

@endsection

@section("header","Users")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">users</a></li>

@endsection

@section("content")

    {{ $dataTable->table() }}

@endsection



@section('scripts')
    {{ $dataTable->scripts() }}
@endsection
