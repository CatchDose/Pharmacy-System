<x-mail::message>
# Confirm Order Price
 
Your Order Info:

<x-mail::table>
| Item          | Qty           | Price    |
| ------------- |:-------------:| --------:|
@foreach($orderInfo as $info)
| {{$info['medicine']}}      | {{$info['quantity']}}      | {{$info['price']}}      |
@endforeach
| Total Price  |                  | {{$totalPrice}}    |
</x-mail::table>
 
<form action="{{$url}}">

    <input type="submit">Confirm</button>
</form>
<a href="{{$url}}">link</a>

<x-mail::button :url="$url">
Confirm Order
</x-mail::button>
 
</x-mail::message>