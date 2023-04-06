@extends("layouts.app")

@section('title' , 'Create')

@section('style')

@endsection


@section("header","Orders")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection


@section('content')

<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Order</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('orders.store')}}" method="post">
          @csrf
            <div class="card-body">

                <div class="form-group" data-select2-id="13">
                  <label for="userName">User Name</label>
                  <select name="userName" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    @foreach($users as $user)
                    <option>{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group" data-select2-id="13">
                  <label for="insured">Is insured ?</label>
                  <select name="insured" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                    <option>Yes</option>
                    <option>No</option>

                  </select>
                </div>

                <div class="form-group">
                  <label for="med[]" class="form-label">Medicine</label>

                  <select class="js-example-basic-multiple select2 @error('med') is-invalid @enderror" name="med[]" multiple="multiple" style="width: 100%;" >

                    @foreach($medicine as $med)

                      <option value="{{$med->id}}">{{$med->name}}</option>

                    @endforeach

                  </select>

                  @error('med')
                      <span class="invalid-feedback fs-6" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>

                  <div class="form-group">
                    <label for="qty[]" class="form-label">Qty</label>

                    <select class="js-example-basic-multiple select2 @error('qty') is-invalid @enderror" name="qty[]" multiple="multiple" style="width: 100%;">

                    @for($x=1;$x<=10;$x++)
                        <option value="{{$x}}">{{$x}}</option>
                    @endfor

                    </select>

                    @error('qty')
                      <span class="invalid-feedback fs-6" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>

                  <div class="form-group">
                        <label for="DocName">Doctor Name</label>
                        <select name="DocName" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                          @foreach($doctors as $doctor)
                          <option>{{$doctor->name}}</option>
                          @endforeach
                        </select>
                  </div>

                  <div class="form-group">
                        <label for="PharmacyName">Pharmacy Name</label>
                        <select name="PharmacyName" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                          @foreach($pharmacy as $phar)
                          <option>{{$phar->name}}</option>
                          @endforeach
                        </select>
                  </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-dark w-100">Create</button>
            </div>

        </form>
    </div>


@endsection
