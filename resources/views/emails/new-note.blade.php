<x-mail::message>
Nouvelle notification <br>

TItre: {{$note->note_title}},
Contenu :
{{ $note->content }} .
Date: {{$note->note_date->format('d/m/Y H:i')}}
<x-mail::button :url="$confirmUrl">
OK
</x-mail::button>
Merci,<br>
{{config('app.name')}}
<img src="{{ $trackUrl }}" width="1" height="1" style="display:none" alt="">
</x-mail::message>