<x-mail::message>
Rappel : {{ $rappel->remind_title }} <br>
Bonjour , <br>
{{ $individu->name }} {{ $individu->firstname }}, <br>
Ceci est un rappel concernant la note liée : {{ $rappel->notes->note_title }}.
<br>
<x-mail::button :url="$confirmUrl">
OK
</x-mail::button>
Merci,<br>
{{config('app.name')}}
<img src="{{ $trackUrl }}" width="1" height="1" style="display:none" alt="">
</x-mail::message>