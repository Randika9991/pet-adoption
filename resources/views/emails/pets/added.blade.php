@component('mail::message')
# New Pet Added

A new pet named **{{ $pet->name }}** has been added.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

