@component('mail::message')
    
From: {{ $data['name'] }}<br><br>
Email: {{ $data['email'] }}<br><br>
Message: {{ $data['content'] }}

@component('mail::button', ['url' =>'https://google.com'])
Click here 
@endcomponent

@endcomponent