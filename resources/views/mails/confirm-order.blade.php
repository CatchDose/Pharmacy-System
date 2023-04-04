<x-mail::message>
# Confirm Order Price

Your Order Info:

<x-mail::table>
| Item          | Qty           | Price    |
| ------------- |:-------------:| --------:|
@foreach($orderInfo as $info)
| {{$info['medicine']}}      | {{$info['quantity']}}      | {{$info['price']}}$      |
@endforeach
| Total Price  |            | {{$totalPrice}}    |
</x-mail::table>


@component('mail::button', ['url' => $url])
    Confirm
@endcomponent


</x-mail::message>
