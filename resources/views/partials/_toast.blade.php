
<div class="toast-container mt-5 p-3 top-0 end-0" id="toastPlacement" data-original-class="toast-container p-3">
    <div class="toast bg-succes fade" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body d-flex align-items-center"></div>
    </div>
</div>

<script>
    function modalShow(event){
        var toast=new bootstrap.Toast(document.querySelector(".toast"),{"delay":5000});

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
                        $('.table.dataTable').DataTable().ajax.reload();
                    }else{
                        document.querySelector(".toast-body").innerHTML=`<i class="bi bi-exclamation-circle text-danger fs-3 me-2"></i> ${res["error"]}`;
                        toast.show()
                    }
                })
        })
    }
</script>
