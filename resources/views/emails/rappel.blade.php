<x-mail::message>
    Rappel : {{ $rappel->remind_title }}
    Bonjour ,
    {{ $individu->name }} {{ $individu->firstname }},
    @if($rappel->notes)
    Ceci est un rappel concernant la note liée : {{ $rappel->notes->note_title }}.
    <x-mail::button :url="$noteUrl">
        voir note
    </x-mail::button>
    @else
    ceci est une rappel non liée à aucun note
    @endif
    Merci,<br>
    {{config('app.name')}}

    @if($rappel->notes)
    <img src="{{ $trackUrl }}" width="1" height="1" style="display:none" alt="">
    @endif
</x-mail::message>