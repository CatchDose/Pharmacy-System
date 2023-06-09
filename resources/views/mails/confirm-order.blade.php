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


<x-mail::button :url="$confirmUrl" color="success">
    Confirm Order
</x-mail::button>

<x-mail::button :url="$cancelUrl" color="error">
    cancel order
</x-mail::button>


</x-mail::message>
