{{$order->id}}<br>
@if(isset($order->user))
    {{$order->user->name}}
    @endif
@foreach($order->products as $product)
    {{$product->id}}
    @endforeach
