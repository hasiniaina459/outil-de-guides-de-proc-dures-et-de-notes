<x-mail::message>
felicitation {{ $individu->name }} {{ $individu->firstname }}

vous avez maintenant accés à tout les fonctionnalité de l'outil.

<x-mail::button :url="route('login')">se connecter</x-mail::button>

merci,<br>
{{config('app.name')}}
</x-mail::message>