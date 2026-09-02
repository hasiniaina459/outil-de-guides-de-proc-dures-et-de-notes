@extends('layouts.app')
@section('title', 'Modifier la procédure')
@section('content')
    <h1>Modifier la procédure</h1>
    <a href="{{ route('procedures.index') }}" class="btn-index">Retour à la liste des procédures</a>
    <form action="{{ route('procedures.update', $procedures->id_procedure) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="procedure_title">Nom:</label>
            <input type="text" name="procedure_title" id="procedure_title" value="{{ old('procedure_title', $procedures->procedure_title) }}" placeholder="Entrez le nom de la procédure" required>
            @error('procedure_title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Entrez la description de la procédure" required>{{ old('description', $procedures->description) }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="procedure_status">Statut:</label>
            <input type="radio" name="procedure_status" value="En cours" {{ old('procedure_status', $procedures->procedure_status) == 'En cours' ? 'checked' : '' }}> En cours
            <input type="radio" name="procedure_status" value="Terminé" {{ old('procedure_status', $procedures->procedure_status) == 'Terminé' ? 'checked' : '' }}> Terminé
            @error('procedure_status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="id_service">Service:</label>
            @foreach($services as $service)
                <input type="checkbox" name="service[]" id="service_{{ $service->id_service }}" value="{{ $service->id_service }}" 
                {{ in_array($service->id_service, old('id_service', $procedures->services->pluck('id_service')->toArray())) ? 'checked' : '' }}>
                <label for="service_{{ $service->id_service }}">{{ $service->service_name }}</label>
            @endforeach
            @error('id_service')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Mettre à jour la procédure</button>
    </form>
@endsection