@component('mail::message')
# Welcome, {{ $name }}

We are excited to have you with us.  
Feel free to explore our services and contact us if you need support.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
