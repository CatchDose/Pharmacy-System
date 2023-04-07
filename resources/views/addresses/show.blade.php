@extends("layouts.app")

@section("title","Show Address")

@section("style")

@endsection

@section("header","Show Address")

@section("breadcrumb")

    <li class="breadcrumb-item"><a href="{{route("index")}}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">show address</a></li>

@endsection

@section("content")

    <div class="card card-primary">

        <div class="card-body">
            <strong> User Name</strong>
            <p class="text-muted">
                {{ $address->user->name }}
            </p>
            <strong> Area Name</strong>
            <p class="text-muted">
                {{ $address->area->name }}
            </p>
            <strong> Street Name</strong>
            <p class="text-muted">
                {{ $address->street_name }}
            </p>
            <strong> Building Number</strong>
            <p class="text-muted">
                {{ $address->building_number }}
            </p>
            <hr>
            <strong> Floor Number</strong>
            <p class="text-muted">
                {{ $address->floor_number }}
            </p>
            <hr>
            <strong>Flat Number</strong>
            <p class="text-muted">
                {{ $address->flat_number }}
            </p>
            <hr>
            <strong> Is this the user main address?</strong>
            <p class="text-muted">
                @if($address->is_main == 1)
                    <p class="text-muted">
                        Yes
                    </p>
                @else
                    <p class="text-muted">
                        No
                    </p>
                @endif
            </p>
        </div>
    </div>
@endsection



