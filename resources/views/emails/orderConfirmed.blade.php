@component('mail::message')
    <h1>Order Confirmation #{{ $order->id }}</h1>
    <p>{{ explode(' ', $order->recipient->name)[0] }}, thank you for your order. </p>
    <p>We have recieved it and will contact you again as soon as the order has been shipped. You can read an order summary below.</p>
    <br>
    <h2>Order summary</h2>
    @foreach ($order->orderItems as $item)
    <ul class="table">
        <li><h3>Poster, "{{ $item->product->poster->title }}"</h3></li>
        <li><span>Frame: </span> <span>{{ $item->product->variant->posterFrame ? $item->product->variant->posterFrame->name : 'No frame' }}</span></li>
        <li><span>Dimensions: </span> <span>{{ $item->product->variant->posterSize->width }} x {{ $item->product->variant->posterSize->height }} cm</span></li>
        <li><span>Design: </span><span><a class="text-link" href="{{ env('APP_URL') . '/edit-poster/' . $item->product->poster->id }}">Click here</a></span></li>
        <li><span>Quantity: </span> <span>{{ $item->quantity }}</span></li>
        <li><span>Price: </span> <span>€{{ number_format($item->product->variant->price / 100, 2, '.', '') }}</span></li>
    </ul>
    <br>
    @endforeach
    <h2>Order total</h2>
    <ul class="table">
        <li class="columns">
            <span>Subtotal: </span> <span> €{{ number_format(($order->total - $order->shipping->cost) / 100, 2, '.', '') }}</span>
        </li>
        <li>
            <span>Shipping: </span> <span> €{{ number_format($order->shipping->cost / 100, 2, '.', '') }}</span>
        </li>
        <li>
            <span>Total: </span> <span> €{{ number_format($order->total / 100, 2, '.', '') }}</span>
        </li>
    </ul>
    <br>
    <h2>Shipping information</h2>
    <ul class="table">
        <li>
            <span>Method: </span> <span>{{ $order->shipping->name }}</span>
        </li>
        <li>
            <span>Name: </span> <span>{{ $order->recipient->name }}</span>
        </li>
        <li>
            <span>Country: </span>
            <span>{{ $order->recipient->country . ($order->recipient->state_code ? ', ' . $order->recipient->state_code : '') }}</span>
        </li>
        <li>
            <span>Address: </span>
            <span>{{ $order->recipient->address1 . ', ' . $order->recipient->address2 }}</span>
        </li>
        <li>
            <span>City: </span> <span>{{ $order->recipient->city . ', ' . $order->recipient->zip }}</span>
        </li>
    </ul>
    <a class="button-black" href="https://customchessposters.com/create-poster/">Create more posters!</a>
@endcomponent
