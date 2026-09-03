@extends('layouts.app')
@section('title','création service')
@section('content')
    <div class="retour">
        <a href="{{ route('services.index') }}" class="btn-index">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                fill="currentColor" viewBox="0 0 24 24">
                <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                <path d="M15 11H8v2h7v4l6-5-6-5z"></path>
                <path d="M5 21h7v-2H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"></path>
            </svg>
        </a>
        <h1>Création d'un service</h1>
    </div>
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