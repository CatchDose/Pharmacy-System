@extends("layouts.app")

@section("title","Addresses")

@section("style")

@endsection

@section("header","Addresses")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">addresses</a></li>

@endsection

@section("content")

    {{ $dataTable->table() }}

@endsection



@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

