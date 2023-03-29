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

    <table>
        <tbody>
        <tr>
            <th>User Name</th>
            <td>{{ $address->user->name }}</td>
        </tr>
        <tr>
            <th style="width: 20vh">Street Name</th>
            <td>{{ $address->street_name }}</td>
        </tr>
        <tr>
            <th>Building Number</th>
            <td>{{ $address->building_number }}</td>
        </tr>
        <tr>
            <th>Floor Number</th>
            <td>{{ $address->floor_number }}</td>
        </tr>
        <tr>
            <th>Flat Number</th>
            <td>{{ $address->flat_number }}</td>
        </tr>
        <tr>
            <th>Main Address</th>
            @if($address->is_main == 1)
                <td>Yes</td>
            @else
            <td>No</td>
            @endif
        </tr>
        <tr>
            <th>Area</th>
            <td>{{ $address->area->name }}</td>
        </tr>
        </tbody>
    </table>


@endsection



