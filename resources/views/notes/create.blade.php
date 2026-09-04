@extends('layouts.app')
@section('title', 'Création d\'une note')
@section('content')
<div class="retour">
    <a href="{{ route('notes.index') }}" class="btn-index">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            fill="currentColor" viewBox="0 0 24 24">
            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
            <path d="M15 11H8v2h7v4l6-5-6-5z"></path>
            <path d="M5 21h7v-2H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"></path>
        </svg>
    </a>
    <h1>Création d'une note</h1>
</div>
<form action="{{ route('notes.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Titre:</label>
        <input type="text" name="note_title" id="title" value="{{old('note_title')}}" placeholder="Entrez le titre de la note" required>
        @error('note_title')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="content">Contenu:</label>
        <textarea name="content" id="content" placeholder="Entrez le contenu de la note" required>{{old('content')}}</textarea>
        @error('content')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="status">Statut:</label>
        <select name="note_status" id="note_status" required>
            <option value="0" {{ old('note_status') == '0' ? 'selected' : '' }}>non lu</option>
            <option value="1" {{ old('note_status') == '1' ? 'selected' : '' }}>lu</option>
        </select>
        @error('note_status')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label>Services concernés:</label>
        @foreach($services as $service)
        <div>
            <input type="checkbox" name="service[]" id="service_{{ $service->id_service }}" value="{{ $service->id_service }}"
                {{ in_array($service->id_service, old('service', [])) ? 'checked' : '' }}>
            <label for="service_{{ $service->id_service }}">{{ $service->service_name }}</label>
        </div>
        @endforeach
        @error('service')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Créer la note</button>
</form>
@endsection