@component('mail::message')
<h1>New order recieved</h1>
Order: {{ $order->id }} <br><br>
Total: ${{ $order->total / 100 }} <br><br>
Recipient: {{ $order->recipient->name }} <br><br>
Country: {{ $order->recipient->country }} <br><br>
Status: {{ $order->status }} <br><br>
Last updated at: {{ $order->updated_at }}
@endcomponent