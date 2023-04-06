@extends("layouts.app")

@section("title","Pharmacy")

@section("style")

@endsection

@section("header","Pharmacy")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Pharmacy</a></li>

@endsection

@section("content")


<div class="card-body">
<strong><i class="fas fa-book mr-1"></i> Pharmacy Name</strong>
<p class="text-muted">
{{$pharmacy->name}}
</p>
<strong><i class="fas fa-solid fa-user"></i> Owner Name</strong>
<p class="text-muted">
{{$pharmacy->owner->name}}
</p>
<strong><i class="fas fa-solid fa-envelope"></i> Email</strong>
<p class="text-muted">
{{$pharmacy->owner->email}}
</p>
<strong><i class="fas fa-phone mr-1"></i> Phone</strong>
<p class="text-muted">
{{$pharmacy->owner->phone}}
</p>
<hr>
<strong><i class="fas fa-map-marker-alt mr-1"></i> Area Name</strong>
<p class="text-muted">{{$pharmacy->area->name}}</p>
<hr>
<strong><i class="fas fa-solid fa-id-card"></i> National id</strong>
<p class="text-muted">
{{$pharmacy->owner->national_id}}

</p>
<hr>
</div>

</div>
@hasanyrole("admin|pharmacy")
<a href="{{route("pharmacies.edit",$pharmacy->id)}}" class="btn btn-dark w-100">edit Pharmacy</a>
@endhasanyrole

@endsection




