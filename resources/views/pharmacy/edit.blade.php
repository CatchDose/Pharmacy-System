@extends("layouts.app")

@section("title","add pharmacy")

@section("style")

@endsection

@section("header","add pharmacy")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Add pharmacy</a></li>

@endsection

@section("content")

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add pharmacy</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{route("pharmacies.update",$pharmacy->id)}}" class="needs-validation">
        @csrf
        @method("PUT")
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Enter Name" value="{{old("name")??$pharmacy->name}}">
                @error('name')
                    <div class="invalid-feedback" @style(["display: block"])>
                        {{ $message }}
                    </div>
                @enderror
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{old("email")??$pharmacy->owner->email}}">
                @error('email')
                    <div class="invalid-feedback" @style(["display: block"])>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback" @style(["display: block"])>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputNationalId1">National Id</label>
                <input type="text" name="national_id" class="form-control" id="exampleInputNationalId1" placeholder="Enter National Id" value="{{old("national_id")??$pharmacy->owner->national_id}}">
                @error('national_id')
                    <div class="invalid-feedback" @style(["display: block"])>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPhone1">Phone</label>
                <input type="text" name="phone" class="form-control" id="exampleInputPhone1" placeholder="Enter Phone" value="{{old("phone")??$pharmacy->owner->phone}}">
                @error('phone')
                    <div class="invalid-feedback" @style(["display: block"])>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputAreaId1">Area</label>
                <select name="area_id" class="form-select">
                    @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->name}}</option>
                    @endforeach
                </select>
                @error('area_id')
                    <div class="invalid-feedback" @style(["display: block"])>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPriority1">Priority</label>
                <input type="text" name="priority" class="form-control" id="exampleInputPriority1" placeholder="Enter Priority" value="{{old("priority")??$pharmacy->priority}}">
                @error('priority')
                    <div class="invalid-feedback" @style(["display: block"])>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file"name="avatar_image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection



