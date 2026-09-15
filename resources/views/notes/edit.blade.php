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
        <label for="categorie">categorie</label>
        @php
        // old() en priorité (si la validation a échoué), sinon les catégories déjà en base
        $categoriesSelectionnes = old('categorie', $notes->categorie ?? []);
        @endphp
        <div class="chip-grp">
            <input type="checkbox" name="categorie[]" class="chip-inp" id="info" value="information" 
                {{ in_array('information',$categoriesSelectionnes) ? 'checked' : '' }}>
            <label for="info" class="chip-lab"> information</label>
            <input type="checkbox" name="categorie[]" class="chip-inp" id="new" value="nouvelle" 
                {{ in_array('nouvelle',$categoriesSelectionnes) ? 'checked' : '' }}>
            <label for="new" class="chip-lab"> nouvelle</label>
            <input type="checkbox" name="categorie[]" class="chip-inp" id="fns" value="termine"
                {{ in_array('termine',$categoriesSelectionnes) ? 'checked' : '' }}>
            <label for="fns" class="chip-lab"> terminer</label>
            @error('categorie')
            <div class="error">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div>
        <label>Services concernés:</label>
        <div class="chip-grp">
            @foreach($services as $service)
            <input type="checkbox" name="service[]" class="chip-inp" id="service_{{ $service->id_service }}" value="{{ $service->id_service }}"
                {{ in_array($service->id_service, old('service', $notes->services->pluck('id_service')->toArray())) ? 'checked' : '' }}>
            <label for="service_{{ $service->id_service }}" class="chip-lab">{{ $service->service_name }}</label>
            @endforeach
        </div>
        @error('service')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Mettre à jour la note</button>
</form>
@endsection