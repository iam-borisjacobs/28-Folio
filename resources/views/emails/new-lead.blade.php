@component('mail::message')
# New Lead Received

You have received a new contact form submission.

**Name:** {{ $lead->name }}  
**Email:** {{ $lead->email }}  
**Subject:** {{ $lead->subject }}

**Message:**
@component('mail::panel')
{{ $lead->message }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
