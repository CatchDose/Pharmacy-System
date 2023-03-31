@extends("layouts.app")

@section("title","Edit User")

@section("style")

@endsection

@section("header","Edit User")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route('areas.index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">edit area</a></li>

@endsection

@section("content")
<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add area</h3>
        </div>
<form action='{{route("areas.update",$area->id)}}' method="post" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method("put")

            

                <label for="user-name">COUNTRY</label>
            <select name="country_id" class="form-control mb-2" id="country">
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="user-name">Area Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="areaname" value="{{$area->name}}">
                
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control   @error('name') is-invalid @enderror" name="address" id="address" value="{{$area->address}}">
                
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



