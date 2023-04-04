@extends("layouts.app")

@section('title' , 'Edit')

@section('style')

@endsection

@section("header","Orders")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection

@section('content')

<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Show Order Number {{$order->id}} </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        
            <div class="card-body">

                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" value="{{$order->user->name}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Is Insured ?</label>
                    <input type="text" value="{{$order->is_insured}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Pharmacy</label>
                    <input type="text" value="{{$order->pharmacy->name ?? ''}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Doctor ID</label>
                    <input type="text" value="{{$order->doctor->id ?? ''}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" value="{{$order->status}}" class="form-control" disabled>
                </div>

                
                <div id="carouselExampleControls" class="carousel slide w-50 h-50" data-bs-ride="carousel">
                <label>Client Prescription</label>
                    <div class="carousel-indicators">
                    @foreach($prescriptions as $prescription)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->index}}" @if ($loop->first) aria-current="true" class="active" @endif aria-label="Slide {{$loop->iteration}}"></button>
                    @endforeach
                    </div>
                    <div class="carousel-inner ">
                        @foreach($prescriptions as $prescription) 
                        <div class="carousel-item @if($loop->first) active @endif">
                            <img src="{{asset($prescription->path)}}" class="d-block w-100" alt="prescription image">
                        </div>
                        @endforeach
                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>

                @if(count($order->medicines)== 0)
                <label class="text-danger fs-4 mt-4">Please Insert client Medicine</label>
                <form action="{{route('orders.assign' , $order->id)}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">

                  <label for="med[]" class="form-label">Medicine</label>

                  <select class="js-example-basic-multiple select2 @error('med') is-invalid @enderror" name="med[]" multiple="multiple" style="width: 100%;" >
                      
                    @foreach($medicines as $medicine)

                      <option value="{{$medicine->id}}">{{$medicine->name}}</option>

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

                <button type="submit" class="btn btn-dark w-100">Assign</button>

                </form>
                @endif

            </div>
            <!-- /.card-body -->

    </div>

@endsection