@extends('layouts.app')
@section('title', 'Modifier le service')
@section('content')
    <h1>Modifier le service</h1>
    <a href="{{ route('services.index') }}" class="btn-index">Retour à la liste des services</a>
    <form action="{{ route('services.update', $services->id_service) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="service_name">Nom:</label>
            <input type="text" name="service_name" id="service_name" value="{{ old('service_name', $services->service_name) }}" placeholder="Entrez le nom du service" required>
            @error('service_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Entrez la description du service" required>{{ old('description', $services->description) }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Mettre à jour le service</button>
    </form>
@endsection