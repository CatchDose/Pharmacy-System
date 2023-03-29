@extends("layouts.app")

@section("title","Add area")

@section("style")

@endsection

@section("header","Add area")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">add area</a></li>

@endsection

@section("content")

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add area</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('areas.store')}}" method="post">
            <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="user-name">Name</label>
                        <input type="text" value="{{old("name")}}" class="form-control @error('name') is-invalid @enderror" name="name" id="user-name"
                               placeholder="Enter user name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" value="" class="form-control   @error('name') is-invalid @enderror" name="address" id="user-name"
                               placeholder="Enter Address">

                               @error('address')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                    </div>
                
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection



