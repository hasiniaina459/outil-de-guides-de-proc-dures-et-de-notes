@extends('layouts.app')
@section('title', 'afficher la liste des individus')    
@section('content')
    <h1>Liste des individus</h1>
    <a href="{{ route('individus.index') }}" class="btn-index">Retour à la liste</a>
    <button type="button" onclick="window.print()" class="btn-show">Imprimer</button>
    <p><strong>Nom:</strong> {{ $individus->name }}</p>
    <p><strong>Prénom:</strong> {{ $individus->firstname }}</p>
    <p><strong>Email:</strong> {{ $individus->email }}</p>
    <p><strong>Téléphone:</strong> {{ $individus->phone }}</p>
    <p><strong>Préférences de notification:</strong> {{ implode(', ', $individus->notif_preference) }}</p>
@endsection