@component('mail::message')

<h1>Welcome as a new user {{ $data }}!</h1>

<p>We cant wait to see what awesome posters you will create.</p>

@component('mail::button', ['url' =>'https://google.com'])
Start creating your own poster here!
@endcomponent

@endcomponent