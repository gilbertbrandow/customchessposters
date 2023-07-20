@component('mail::message')
<h1>New order recieved</h1>
Order: {{ $order->id }} <br><br>
Total: ${{ $order->totalAmount() / 100 }} <br><br>
Recipient: {{ $order->shippingAddress->name }} <br><br>
Country: {{ $order->shippingAddress->country }} <br><br>
Status: {{ $order->status }} <br><br>
Last updated at: {{ $order->updated_at }}
@endcomponent