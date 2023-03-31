@extends("layouts.app")

@section("title","Pharmacies")

@section("style")

@endsection

@section("header","Pharmacies")

@section("breadcrumb")


    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Pharmacies</a></li>

@endsection

@section("content")

    {{ $dataTable->table() }}

@endsection


@section("extra")
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">delete pharmacy</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-circle text-danger fs-3 me-2"></i>
                            Deleting this pharmacy will delete all doctors and orders assigned to it.<br>
                            Are you sure you want to continue?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="modalNo">no</button>
                    <button type="button" class="btn btn-danger">yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container p-3 top-0 end-0" id="toastPlacement" data-original-class="toast-container p-3">
        <div class="toast bg-succes fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body d-flex align-items-center"></div>
        </div>
    </div>

    
@endsection


@section('scripts')
{{ $dataTable->scripts() }}
   <script>
    var toast=new bootstrap.Toast(document.querySelector(".toast"),{"delay":10000});
    
    function modalShow(event){
        event.preventDefault();
        event.stopPropagation();

        document.querySelector(".modal-footer").lastElementChild.addEventListener("click",(e)=>{

            fetch(event.target.closest("form").action,{
                method: "DELETE", 
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            .then((res,err)=>{
                document.getElementById("modalNo").click();
                return res.json();
            })
            .then(res=>{
                console.log(res);
                if(res["success"]){
                    document.querySelector(".toast-body").innerHTML=`<i class="bi bi-check-circle text-success fs-3 me-2"></i> ${res["success"]}`;
                    toast.show()
                    $('#pharmacies-table').DataTable().ajax.reload();
                }else{
                    document.querySelector(".toast-body").innerHTML=`<i class="bi bi-exclamation-circle text-danger fs-3 me-2"></i> ${res["error"]}`;
                    toast.show()
                }
            })
        })
    }
    
   </script>

@endsection
