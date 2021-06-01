@component('mail::message')
# Idea Status Updated

The Idea: {{ $idea->title }}

has been updated to a status of

{{ $idea->status->name }}

@component('mail::button', ['url' => route('ideas.show', $idea)])
View Idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
