@extends("layouts.app")

@section("title","add medicine")

@section("style")
<link rel="stylesheet" href="{{asset("plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section("header","Add medicine")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route("medicines.index")}}">medicines</a></li>
    <li class="breadcrumb-item">add medicine</li>

@endsection

@section("content")

            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route("medicines.store")}}" class="needs-validation">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName1">medicine Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Enter medicine Name" value="{{old("name")}}">
                            @error('name')
                                <div class="invalid-feedback" @style(["display: block"])>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">type</label>
                            <select class="js-example-basic-multiple select2 " name="type" style="width: 100%;" >
                                @foreach($Medicines as $medicine)
                                <option value="{{$medicine->name}}">{{$medicine->type}}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback" @style(["display: block"])>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone1">price</label>
                            <input type="text" name="price" class="form-control" id="exampleInputprice1" placeholder="Enter price" value="{{old("price")}}">
                            @error('price')
                                <div class="invalid-feedback" @style(["display: block"])>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>
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
