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
                  <!-- </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-o8pk-container"><span class="select2-selection__rendered" id="select2-o8pk-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                </div>

                <div class="form-group" data-select2-id="13">
                  <label for="insured">Is insured ?</label>
                  <select name="insured" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    
                    <option>Yes</option>
                    <option>No</option>
                   
                  </select>
                  <!-- </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-o8pk-container"><span class="select2-selection__rendered" id="select2-o8pk-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                </div>

                <div class="form-group">
                  <label for="med[]" class="form-label">Medicine</label>

                  <select class="js-example-basic-multiple select2 @error('med[]') is-invalid @enderror" name="med[]" multiple="multiple" style="width: 100%;" >
                      
                    @foreach($medicine as $med)

                      <option value="{{$med->id}}">{{$med->name}}</option>

                    @endforeach

                  </select>

                  @error('med[]')
                      <span class="invalid-feedback fs-6" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>

                  <div class="form-group">
                    <label for="qty[]" class="form-label">Qty</label>

                    <select class="js-example-basic-multiple select2 @error('qty[]') is-invalid @enderror" name="qty[]" multiple="multiple" style="width: 100%;">
                        
                    @for($x=1;$x<=10;$x++)
                        <option value="{{$x}}">{{$x}}</option>
                    @endfor
                    </select>

                    @error('qty[]')
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










