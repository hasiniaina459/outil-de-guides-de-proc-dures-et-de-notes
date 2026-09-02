@extends('layouts.app')
@section('title', 'Création d\'une procédure')
@section('content')
    <h1>Création d\'une procédure</h1>
    <a href="{{ route('procedures.index') }}" class="btn-index">Retour à la liste des procédures</a>
    <form action="{{ route('procedures.store') }}" method="POST">
        @csrf
        <div>
            <label for="procedure_title">Nom:</label>
            <input type="text" name="procedure_title" id="procedure_title" value="{{old('procedure_title')}}" placeholder="Entrez le nom de la procédure" required>
            @error('procedure_title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Entrez la description de la procédure" required>{{old('description')}}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="status">Statut:</label>
            <input type="radio" name="status" value="0" id="status" {{ old('status') ? 'checked' : '' }}>effectuer
            <input type="radio" name="status" value="1" id="status" {{ old('status') ? 'checked' : '' }}>non effectuer
            @error('procedure_status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="id_service">Service:</label>
            @foreach($services as $service)
            <div>
                <input type="checkbox" name="service[]" value="{{ $service->id_service }}" id="service_{{ $service->id_service }}"
                {{in_array($service->id_service, old('service', [])) ? 'checked' : '' }}>
                <label for="service_{{ $service->id_service }}">{{ $service->service_name }}</label>
            </div>
            @endforeach
            @error('id_service')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Créer la procédure</button>
    </form>
@endsection