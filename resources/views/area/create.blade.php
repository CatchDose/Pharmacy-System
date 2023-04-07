@extends("layouts.app")

@section("title","Add area")

@section("style")

@endsection

@section("header","Add area")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route("areas.index")}}">areas</a></li>
    <li class="breadcrumb-item">add area</li>

@endsection

@section("content")

<div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('areas.store')}}" method="post">
        <div class="card-body">
            @csrf

            <label for="user-name">COUNTRY</label>
            <select name="country_id" class="form-control mb-2 select2" id="country">
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="user-name">Area Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="areaname" placeholder="Enter area name">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" value="" class="form-control   @error('name') is-invalid @enderror" name="address" id="address" placeholder="Enter Address">

                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-dark w-100">Submit</button>
        </div>
    </form>
</div>

@endsection
