<x-mail::message>
Rappel : {{ $rappel->remind_title }}
Bonjour ,
{{ $individu->name }} {{ $individu->firstname }},
Ceci est un rappel concernant la note liée : {{ $rappel->notes->note_title }}.
<x-mail::button :url="$noteUrl">
voir note
</x-mail::button>
Merci,<br>
{{config('app.name')}}
<img src="{{ $trackUrl }}" width="1" height="1" style="display:none" alt="">
</x-mail::message>