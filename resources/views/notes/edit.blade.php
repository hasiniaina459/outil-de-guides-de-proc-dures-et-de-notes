@extends('layouts.app')
@section('title', 'Modifier la note')
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
    <h1>Modifier la note</h1>
</div>
<form action="{{ route('notes.update', $notes->id_note) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="note_title">Titre:</label>
        <input type="text" name="note_title" id="note_title" value="{{ old('note_title', $notes->note_title) }}" placeholder="Entrez le titre de la note" required>
        @error('note_title')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="content">Contenu:</label>
        <textarea name="content" id="content" placeholder="Entrez le contenu de la note" required>{{ old('content', $notes->content) }}</textarea>
        @error('content')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="note_status">Statut:</label>
        <input type="radio" name="note_status" value="0" {{ old('note_status', (int) $notes->note_status) == 0 ? 'checked' : '' }}> non lu
        <input type="radio" name="note_status" value="1" {{ old('note_status', (int) $notes->note_status) == 1 ? 'checked' : '' }}> lu
        @error('note_status')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label>Services concernés:</label>
        @foreach($services as $service)
        <div>
            <input type="checkbox" name="service[]" id="service_{{ $service->id_service }}" value="{{ $service->id_service }}"
                {{ in_array($service->id_service, old('service', $notes->services->pluck('id_service')->toArray())) ? 'checked' : '' }}>
            <label for="service_{{ $service->id_service }}">{{ $service->service_name }}</label>
        </div>
        @endforeach
        @error('service')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Mettre à jour la note</button>
</form>
@endsection