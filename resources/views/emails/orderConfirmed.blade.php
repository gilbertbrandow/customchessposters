@component('mail::message')
<h1>Order Confirmation #{{ $order->id }}</h1>
<p>{{ explode(' ', $order->shippingAddress->name)[0] }}, thank you for your order. </p>

<p>We have recieved it and will contact you again as soon as the order has been shipped. You can read an order summary
    below.</p>

<h2>Order total</h2>
<ul>
    <li>
        <span>Subtotal: ${{ ($order->totalAmount() - $order->shipping_cost) / 100 }}</span>
    </li>

    <li>
        <span>Shipping: ${{ $order->shipping_cost / 100 }}</span>
    </li>

    <li>
        <span>Total: ${{ $order->totalAmount() / 100 }}</span>
    </li>
</ul>

<h2>Shipping</h2>
@endcomponent
