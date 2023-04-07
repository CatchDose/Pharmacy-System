@extends("layouts.app")

@section("title","Home")

@section("style")

@endsection

@section("header","Home page")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Home</a></li>

@endsection

@section("content")
    <h1 class="mb-4">Pharmacy System</h1>
    <div class="container-fluid">
        @hasanyrole("admin|pharmacy")
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$new_orders}}</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route("orders.index")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$total_orders}}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route("orders.index")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>$ {{$sumRevenues}}</h3>
                        <p>Revenues</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route("revenues.index")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$clients??'0'}}</h3>
                        <p>Clients</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>

                    <a href="@role('admin') {{route('users.index')}} @else # @endrole" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                </div>
            </div>
        </div>
        @endhasanyrole
        <div class="d-flex justify-content-center align-items-center">
            <img class="animation__shake img-fluid w-25" src="{{asset("dist/img/catch.png")}}" style="z-index:5;">
        </div>

    </div>

@endsection

@section("script")

@endsection
