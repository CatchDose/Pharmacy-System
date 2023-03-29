@extends("layouts.app")

@section("title","Medicines")

@section("style")

@endsection

@section("header","Medicines")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Medicines</a></li>

@endsection

@section("content")

    {{ $dataTable->table() }}

@endsection



@section('scripts')
{{ $dataTable->scripts() }}
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
