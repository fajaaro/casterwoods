@component('mail::message')

Hello {{ $user->name }},

<br>

There is a new transaction with key <b>{{ $transaction->order_key }}</b> made by user named {{ $transaction->user->name }}.
You can check the details by <a href="{{ config('app.url') }}"><b>logging in</b></a> first and go to admin page. 

<br>
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
