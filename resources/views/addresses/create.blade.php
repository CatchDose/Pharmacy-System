@extends("layouts.app")

@section("title","Add Address")

@section("style")

@endsection

@section("header","Add Address")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">add Address</a></li>

@endsection

@section("content")

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Address</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route("addresses.store")}}" method="post">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="street-name">Street name</label>
                    <input type="text" value="{{old("street_name")}}" class="form-control @error('street_name') is-invalid @enderror" name="street_name" id="street-name"
                           placeholder="Enter user name">

                    @error('street_name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="building-number">Building number</label>
                    <input type="text" value="{{old("building_number")}}" class="form-control @error('building_number') is-invalid @enderror" name="building_number" id="building-number"
                           placeholder="Enter Building number">

                    @error('building_number')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="building-number">Is this your main Address?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_main" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_main" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>

                    @error('is_main')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="area-id">Area id</label>
                    <input type="text" value="{{old("area_id")}}" class="form-control @error('area_id') is-invalid @enderror" name="area_id" id="area-id" placeholder="Area id">

                    @error('area_id')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="user-id">User id</label>
                    <input type="text" value="{{old("user_id")}}" class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user-id"
                           placeholder="Enter date">
                    @error('user_id')
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



