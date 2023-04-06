@extends("layouts.app")

@section("title","Addresses")

@section("style")

@endsection

@section("header","Addresses")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item">addresses</li>

@endsection

@section("content")

    {{ $dataTable->table() }}

@endsection
@section("extra")
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">delete Address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Address?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="modalNo">no</button>
                    <button type="button" class="btn btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('scripts')
    {{ $dataTable->scripts() }}

@endsection
