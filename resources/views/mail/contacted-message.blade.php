<x-mail::message>
# Hi, there

Someone contacted you with this messages:

"{{ $message }}"

Maybe, you would like to get in touch, user this shared email: {{ $email }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
