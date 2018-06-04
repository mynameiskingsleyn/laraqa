@component('mail::message')
# Message from your contact form
{{$name}} sent you an email.
#subject
<h3>{{ $subject }}</h3>
@component('mail::panel')
#message
  {{ $message }}
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
