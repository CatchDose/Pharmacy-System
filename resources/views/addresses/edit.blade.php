@extends("layouts.app")

@section("title","Edit Address")

@section("style")

@endsection

@section("header","Edit Address")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">edit Address</a></li>

@endsection

@section("content")

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Address</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route("addresses.update",$address->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="street-name">Street name</label>
                    <input type="text" value="{{$address->street_name}}" class="form-control @error('street_name') is-invalid @enderror" name="street_name" id="street-name"
                           placeholder="Enter street name">

                    @error('street_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="building-number">Building number</label>
                    <input type="text" value="{{$address->building_number}}" class="form-control @error('building_number') is-invalid @enderror" name="building_number" id="building-number"
                           placeholder="Enter Building number">

                    @error('building_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="floor-number">Floor number</label>
                    <input type="text" value="{{$address->floor_number}}" class="form-control @error('floor_number') is-invalid @enderror" name="floor_number" id="floor-number"
                           placeholder="Enter floor number">

                    @error('floor_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="flat_number">Flat number</label>
                    <input type="text" value="{{$address->flat_number}}" class="form-control @error('flat_number') is-invalid @enderror" name="flat_number" id="flat-number"
                           placeholder="Enter Flat number">

                    @error('flat_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="is_main">Is this your main Address?</label>
                    <div class="form-check">
                        <input class="form-check-input @error('is_main') is-invalid @enderror" type="radio" name="is_main" id="flexRadioDefault1"
                               value="1" {{$address->is_main === "Yes" ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('is_main') is-invalid @enderror" type="radio" name="is_main" id="flexRadioDefault2"
                               value="0" {{$address->is_main === "No" ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>

                    @error('is_main')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="area" class="form-label">Area</label>

                    <select class="js-example-basic-multiple select2 @error('area') is-invalid @enderror" name="area"  style="width: 100%;" >
                        @foreach($areas as $area)
                            <option value="{{$area->id}}" {{ $area->id === $address->area_id ? 'selected' : '' }}>{{$area->name}}</option>
                        @endforeach
                    </select>

                    @error('area')
                    <span class="invalid-feedback fs-6" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="user" class="form-label">User</label>

                    <select class="js-example-basic-multiple select2 @error('user') is-invalid @enderror" name="user"  style="width: 100%;" >
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{ $address->user_id === $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                        @endforeach
                    </select>

                    @error('user')
                    <span class="invalid-feedback fs-6" role="alert">
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



