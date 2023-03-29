@extends("layouts.app")

@section('title' , 'Orders')

@section('style')

@endsection

@section("header","Orders")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection

@section('content')

    {{ $dataTable->table() }}

@endsection

@push('scripts')

    {{ $dataTable->scripts() }}
    
@endpush