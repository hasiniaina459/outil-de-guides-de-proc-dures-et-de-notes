@extends('layouts.app')
@section('title','demande admin')
@section('content')
    <div class="devenir">
        @if(session('error'))
        <div class="error">{{ session('error') }}</div>
        @endif
        <h1>devenir admin</h1>

        <p>
            En devenant administrateur, vous aurez accès à la gestion des individus et des services,
            à la création et modification des procédures, à la publication de notes et notifications,
            ainsi qu'au traitement des demandes d'accès administrateur.
        </p>

        <p>
            Votre demande sera envoyée aux administrateurs actuels, qui pourront l'accepter ou la refuser.
            En cas de refus, vous devrez attendre 3 jours avant de pouvoir soumettre une nouvelle demande.
        </p>
        <form action="{{ route('demandes.store') }}" method="post">
            @csrf
            <button type="submit">soumettre</button>
        </form>
    </div>
@endsection