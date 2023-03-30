@extends("layouts.app")

@section("title","Edit User")

@section("style")

@endsection

@section("header","Edit User")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route('areas.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">edit User</a></li>

@endsection

@section("content")

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add user</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('areas.update',$area->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
                    <div class="card-body">
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$area->name}} " name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Adress</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" value="{{$area->address}}" name="address">
                        </div>
                     
            
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

@endsection



