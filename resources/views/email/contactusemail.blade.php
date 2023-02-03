@component('mail::message')

# {{ $maildata['title'] }}
# {{ $maildata['subject'] }}
# {!! $maildata['message'] !!}
@component('mail::panel')
This is the panel content.
@endcomponent
@component('mail::button', ['url' => $maildata['url'], 'color' => 'success'])
Verify
@endcomponent
Thanks,<br>
DICA
@endcomponent
