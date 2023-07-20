@component('mail::message')
    <h1>Order Confirmation #{{ $order->id }}</h1>
    <p>{{ explode(' ', $order->shippingAddress->name)[0] }}, thank you for your order. </p>
    <p>We have recieved it and will contact you again as soon as the order has been shipped. You can read an order summary below.</p>
    <br>
    <h2>Order summary</h2>
    @foreach ($order->orderItems as $item)
    <ul class="table">
        <li><h3>Poster, "{{ $item->product->poster->title }}"</h3></li>
        <li><span>quantity: </span> <span>{{ $item->quantity }}</span></li>
    </ul>
    <a class="button-black" href="{{ 'https://customchessposters.com/poster/' . $item->product->poster->id }}">See the poster</a>
    <br>
    @endforeach
    <br><br>
    <h2>Order total</h2>
    <ul class="table">
        <li>
            <span>Subtotal: </span> <span>${{ ($order->totalAmount() - $order->shipping_cost) / 100 }}</span>
        </li>
        <li>
            <span>Shipping: </span> <span>${{ $order->shipping_cost / 100 }}</span>
        </li>
        <li>
            <span>Total: </span> <span>${{ $order->totalAmount() / 100 }}</span>
        </li>
    </ul>
    <br>
    <h2>Shipping information</h2>
    <ul class="table">
        <li>
            <span>Name: </span> <span>{{ $order->shippingAddress->name }}</span>
        </li>
        <li>
            <span>Country: </span>
            <span>{{ $order->shippingAddress->country . ($order->shippingAddress->state_code ? ', ' . $order->shippingAddress->state_code : '') }}</span>
        </li>
        <li>
            <span>Address: </span>
            <span>{{ $order->shippingAddress->address1 . ', ' . $order->shippingAddress->address2 }}</span>
        </li>
        <li>
            <span>City: </span> <span>{{ $order->shippingAddress->city . ', ' . $order->shippingAddress->zip }}</span>
        </li>
    </ul>
    <a class="button-black" href="https://customchessposters.com/create-poster/">Create more posters!</a>
@endcomponent
