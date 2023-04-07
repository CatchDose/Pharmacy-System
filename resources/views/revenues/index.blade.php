@extends("layouts.app")

@section("title","Revenues")

@section("style")

@endsection

@section("header","Revenues")

@section("breadcrumb")


    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item">Revenues</li>

@endsection

@section("content")

    {{ $dataTable->table() }}

@endsection


@section('scripts')
{{ $dataTable->scripts() }}


@endsection
