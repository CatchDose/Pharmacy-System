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
        <form action="{{route("users.store")}}" method="post">
            <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="user-name">User name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="user-name"
                               placeholder="Enter user name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="national-id">National_id</label>
                        <input type="text" class="form-control" name="national_id" id="national-id"
                               placeholder="Enter national id">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="1">male</option>
                            <option value="2">female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone">
                    </div>

                    <div class="form-group">
                        <label for="date-of-birth">Phone</label>
                        <input type="date" class="form-control" name="date_of_birth" id="phone"
                               placeholder="Enter date">
                    </div>
                    <div class="form-group">
                        <label for="avatar-image">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="avatar_image" class="custom-file-input" id="avatar-image">
                                <label class="custom-file-label" for="avatar-image">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection



