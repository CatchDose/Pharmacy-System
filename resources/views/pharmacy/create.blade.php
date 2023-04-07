@extends("layouts.app")

@section("title","add pharmacy")

@section("style")
<link rel="stylesheet" href="{{asset("plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section("header","Add pharmacy")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route("pharmacies.index")}}">pharmacies</a></li>
    <li class="breadcrumb-item">add pharmacy</li>

@endsection

@section("content")

                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route("pharmacies.store")}}" class="needs-validation">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName1">Pharmacy Name</label>
                            <input type="text" name="pharmacy_name" class="form-control @error('pharmacy_name') is-invalid @enderror" id="exampleInputName1" placeholder="Enter Pharmacy Name" value="{{old("pharmacy_name")}}">
                            @error('pharmacy_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Your Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Enter Name" value="{{old("name")}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" value="{{old("email")}}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputNationalId1">National Id</label>
                            <input type="text" name="national_id" class="form-control @error('national_id') is-invalid @enderror" id="exampleInputNationalId1" placeholder="Enter National Id" value="{{old("national_id")}}">
                            @error('national_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone1">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="exampleInputPhone1" placeholder="Enter Phone" value="{{old("phone")}}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone1">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                <option value="1" {{old("gender") === "1" ? "selected" : ""}}>male</option>
                                <option value="2" {{old("gender") === "2" ? "selected" : ""}} >female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>date of birth</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="date_of_birth"  class="form-control @error('date_of_birth') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                            </div>
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="exampleInputAreaId1">Area</label>
                            <select name="area_id" class="form-select @error('area_id') is-invalid @enderror">
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}" {{old("area_id") === $area->id ? "selected" : ""}}>{{$area->name}}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPriority1">Priority</label>
                            <input type="text" name="priority" class="form-control @error('priority') is-invalid @enderror" id="exampleInputPriority1" placeholder="Enter Priority" value="{{old("priority")}}">
                            @error('priority')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Avatar image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"name="avatar_image  @error('avatar_image') is-invalid @enderror" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark w-100">Submit</button>
                    </div>
                </form>
            </div>

@endsection



@section("script")
//Date picker

    <script>
    $('#reservationdate').datetimepicker({
            format: 'L'
        });
    $('[data-mask]').inputmask()
    </script>

@endsection
