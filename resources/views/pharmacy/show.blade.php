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

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"> Pharmacy info</h3>
</div>

<div class="card-body">
<strong><i class="fas fa-book mr-1"></i> Name</strong>
<p class="text-muted">
{{$pharmacy->name}}
</p>
<strong><i class="fas fa-solid fa-envelope"></i> Email</strong>
<p class="text-muted">
{{$pharmacy->owner->email}}
</p>
<strong><i class="fas fa-phone mr-1"></i>Phone</strong>
<p class="text-muted">
{{$pharmacy->owner->phone}}
</p>
<hr>
<strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
<p class="text-muted">{{$pharmacy->area->name}}</p>
<hr>
<strong><i class="fas fa-solid fa-id-card"></i> National id</strong>
<p class="text-muted">
{{$pharmacy->owner->national_id}}

</p>
<hr>
</div>

</div>

@endsection




