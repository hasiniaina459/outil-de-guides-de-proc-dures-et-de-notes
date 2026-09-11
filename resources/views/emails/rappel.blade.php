<x-mail::message>
    Rappel:{{ $rappel->remind_title }}
    Bonjour {{ $individu->name}} {{$individu->firstname}},

    Ceci est un rappel concernant la note liée : {{$rappel->notes->note_title}}.
    <x-mail::button :url="route('notes.track',['note' => $rappel->notes->id_note,'individu'=>$individu->id_individu])">
        voir note
    </x-mail::button>
    Merci,<br>
    {{config('app.name')}}
</x-mail::message>

