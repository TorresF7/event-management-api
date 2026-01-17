@component('mail::message')
# {{ __('emails.event_reminder.greeting', ['name' => $user->name]) }}

{{ __('emails.event_reminder.intro') }}

@component('mail::panel')
**{{ __('emails.event_reminder.event') }}:** {{ $event->name }}  
**{{ __('emails.event_reminder.date') }}:** {{ $event->start_time->format('d M Y H:i') }}
@endcomponent

@component('mail::button', ['url' => route('events.show', $event)])
{{ __('emails.event_reminder.action') }}
@endcomponent

{{ __('emails.event_reminder.footer') }}

{{ config('app.name') }}
@endcomponent
