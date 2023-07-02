@component('mail::message')
<h1>Order Confirmation #{{ $order->id }}</h1>
Total: ${{ $order->totalAmount() / 100 }} Status: {{ $order->status }} <br><br>
@endcomponent