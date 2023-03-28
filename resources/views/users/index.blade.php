@extends("layouts.app")

@section("title","Home")

@section("style")

{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />--}}

@endsection

@section("header","Home page")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Home</a></li>

@endsection

@section("content")
    {{ $dataTable->table() }}

@endsection



@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
