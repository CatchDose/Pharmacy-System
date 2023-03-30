@extends("layouts.app")

@section('title' , 'Edit')

@section('style')

@endsection

@section("header","Orders")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection

@section('content')

<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Show Order Number {{$order->id}} </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">

                <div class="form-group">
                    <label for="user-name">User Name</label>
                    <input type="text" value="{{$order->user->name}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="user-name">Is Insured ?</label>
                    <input type="text" value="{{$order->is_insured}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="user-name">Pharmacy</label>
                    <input type="text" value="{{$order->pharmacy->name}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="user-name">Doctor ID</label>
                    <input type="text" value="{{$order->doctor->id}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="user-name">Status</label>
                    <input type="text" value="{{$order->status}}" class="form-control" disabled>
                </div>

            </div>
            <!-- /.card-body -->

        </form>
    </div>

@endsection