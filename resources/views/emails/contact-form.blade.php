<x-mail::message>
# New contact message

A visitor submitted the contact form on the website.

<x-mail::table>
| Field | Detail |
|:--|:--|
| From | {{ $senderName }} |
| Email | [{{ $senderEmail }}](mailto:{{ $senderEmail }}) |
| Subject | {{ $messageSubject }} |
</x-mail::table>

<x-mail::panel>
{{ $messageBody }}
</x-mail::panel>

<x-mail::button :url="route('contact')">
Open the contact page
</x-mail::button>

Regards,<br>
{{ config('app.name') }}

<x-slot:subcopy>
Reply directly to this email to answer {{ $senderName }}.
</x-slot:subcopy>
</x-mail::message>
