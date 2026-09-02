@extends('layouts.app')
@section('title','création service')
@section('content')
    <h1>Création d'un service</h1>
    <a href="{{ route('services.index') }}" class="btn-index">Retour à la liste des services</a>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nom du service:</label>
            <input type="text" name="service_name" id="name" placeholder="Entrez le nom du service" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Entrez la description du service" required></textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Créer le service</button>
    </form>
@endsection