@extends("layouts.app")

@section('title' , 'Create')

@section('style')

@endsection
    

@section("header","Orders")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection


@section('content')

<form action="{{route('orders.store')}}" method="POST">
    @csrf

    <div class="form-group" data-select2-id="13">
      <label for="userName">User Name</label>
      <select name="userName" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
        @foreach($users as $user)
        <option>{{$user->name}}</option>
        @endforeach
      </select>
      <!-- </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-o8pk-container"><span class="select2-selection__rendered" id="select2-o8pk-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
    </div>

  <div class="mb-3">

    <label for="med[]" class="form-label">Medicine</label>

    <select class="js-example-basic-multiple select2 " name="med[]" multiple="multiple" style="width: 100%;" >
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>

    </select>

  </div>

  <div class="mb-3">

    <label for="qty[]" class="form-label">Qty</label>

    <select class="js-example-basic-multiple select2" name="qty[]" multiple="multiple" style="width: 100%;">
        
    @for($x=1;$x<=10;$x++)
        <option value="{{$x}}">{{$x}}</option>
    @endfor

    </select>

  </div>

  <button type="submit" class="btn btn-dark w-100">Create</button>

</form>

@endsection










