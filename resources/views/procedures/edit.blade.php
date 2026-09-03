@extends('layouts.app')
@section('title', 'Modifier la procédure')
@section('content')
    <div class="retour">
        <a href="{{ route('procedures.index') }}" class="btn-index">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                fill="currentColor" viewBox="0 0 24 24">
                <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                <path d="M15 11H8v2h7v4l6-5-6-5z"></path>
                <path d="M5 21h7v-2H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"></path>
            </svg>
        </a>
        <h1>Modifier la procédure</h1>
    </div>
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
                {{ in_array($service->id_service, old('id_service', $procedures->services->pluck('id_service')->toArray())) ? 'checked' : '' }}><label for="service_{{ $service->id_service }}">{{ $service->service_name }}</label>
            @endforeach
            @error('id_service')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Mettre à jour la procédure</button>
    </form>
@endsection