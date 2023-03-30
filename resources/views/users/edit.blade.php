@extends("layouts.app")

@section("title","Add user")

@section("style")

@endsection

@section("header","Add user")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">add user</a></li>

@endsection

@section("content")

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add user</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route("users.update",$user->id)}}" method="put" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method("put")
                <div class="form-group">
                    <label for="user-name">User name</label>
                    <input type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror"
                           name="name" id="user-name"
                           placeholder="Enter user name">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" value="{{$user->email}}"
                           class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                           placeholder="Enter email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="national-id">National id</label>
                    <input type="text" value="{{$user->national_id}}"
                           class="form-control @error('national_id') is-invalid @enderror" name="national_id"
                           id="national-id"
                           placeholder="Enter national id">

                    @error('national_id')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                           id="password"
                           placeholder="Password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                        <option value="1" {{$user->gender === "1" ? "selected" : ""}}>male</option>
                        <option value="2" {{$user->gender === "2" ? "selected" : ""}} >female</option>
                    </select>

                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" value="{{$user->phone}}"
                           class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                           placeholder="Enter phone">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="date-of-birth">date of birth</label>
                    <input type="date" value="{{$user->date_of_birth}}"
                           class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                           id="phone"
                           placeholder="Enter date">
                    @error('date_of_birth')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="avatar-image">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="avatar_image"
                                   class="custom-file-input @error('avatar_image') is-invalid @enderror"
                                   id="avatar-image">
                            <label class="custom-file-label" for="avatar-image">Choose file</label>

                        </div>


                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>


                    </div>
                    @error('avatar_image')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">update</button>
            </div>

        </form>
    </div>

@endsection



