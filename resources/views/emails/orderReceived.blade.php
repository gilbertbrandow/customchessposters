@component('mail::message')
<h1>New order recieved</h1>
Order: {{ $order->id }} <br><br>
Total: ${{ $order->totalAmount() / 100 }} <br><br>
@endcomponent