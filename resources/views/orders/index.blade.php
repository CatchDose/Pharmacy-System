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