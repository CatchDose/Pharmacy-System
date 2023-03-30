@extends("layouts.app")

@section('title' , 'Orders')

@section('style')

@endsection

@section("header","Orders")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="#">Order</a></li>

@endsection

@section('content')

    {{ $dataTable->table() }}

@endsection

@section('extra')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">delete user</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">no</button>
                    <button type="button" class="btn btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    {{ $dataTable->scripts()}}
    <script>
        function modalShow(event){

            event.preventDefault();
            event.stopPropagation();
            document.querySelector(".modal-footer").lastElementChild.addEventListener("click",(e)=>{
                event.target.closest("form").submit();
            })
        }
   </script>
@endsection