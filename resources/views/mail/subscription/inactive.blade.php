@component('mail::message')
# Hi, {{ $name }}!

Hello my inactive friend!
@component('mail::panel')
Click the button.
@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'success'])
Click here.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
