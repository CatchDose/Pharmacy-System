@extends("layouts.app")

@section('title' , 'Edit')

@section('style')

@endsection

@section("header","Orders")

@section("breadcrumb")

@endsection

@section('content')

<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Order Number {{$order->id}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('orders.update' , $order->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <div class="card-body">

                <div class="form-group" data-select2-id="13">
                    <label>Order Status</label>
                    <input type="text" class="form-control" value="{{$order->status}}" disabled>
                </div>
                @if($order->status != 'Waiting')
                <div class="form-group" data-select2-id="13">
                    <label for="status">status</label>
                    <select name="status" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option value="2" {{$order->status == 'Processing' ? 'selected': ""}}>Processing</option>
                        <option value='3' {{$order->status == 'Waiting' ? 'selected': ""}}>Waiting</option>
                        <option value='4' {{$order->status == 'Cancelled' ? 'selected': ""}} >Cancelled</option>
                        <option value='5' {{$order->status == 'Confirmed' ? 'selected': ""}} >Confirmed</option>
                        <option value='6' {{$order->status == 'Delivered' ? 'selected': ""}}>Delivered</option>

                    </select>
                </div>
                @endif

                @if(!Auth::user()->hasRole('doctor'))
                    
                <div class="form-group">
                    <label >Change Client Name</label>
                    <select name="user_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        
                        @foreach($users as $user)
                        <option value="{{$user->id}}" {{$order->user->id === $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" data-select2-id="13">
                  <label >Is insured ?</label>
                  <select name="is_insured" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option {{$order->is_insured == 1 ? 'selected' : '' }}>Yes</option>
                    <option {{$order->is_insured == 0 ? 'selected' : '' }}>No</option>
                  </select>
                </div>

                @if(Auth::user()->hasRole('admin'))
                <div class="form-group">
                    <label for="pharmacy_id">Change Pharmacy Name</label>
                    <select name="pharmacy_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        
                        @foreach($pharmacy as $phar)
                        <option value="{{$phar->id}}" {{$order->pharmacy->id === $phar->id ? 'selected': ''}}>{{$phar->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

             </div>
             <!-- /.card-body -->
 
             <div class="card-footer">
                 <button type="submit" class="btn btn-dark w-100">Update</button>
             </div>

            @endif
                
        </form>
    </div>


@endsection