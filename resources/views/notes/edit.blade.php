@extends('layouts.app')
@section('title', 'Modifier la note')
@section('content')
    <h1>Modifier la note</h1>
    <a href="{{ route('notes.index') }}" class="btn-index">Retour à la liste des notes</a>
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
            <input type="radio" name="note_status" value="En cours" {{ old('note_status', $notes->note_status) == 'En cours' ? 'checked' : '' }}> En cours
            <input type="radio" name="note_status" value="Terminé" {{ old('note_status', $notes->note_status) == 'Terminé' ? 'checked' : '' }}> Terminé
            @error('note_status')
                <div class="error">{{ $message }}</div> 
            @enderror
        </div>
        <button type="submit">Mettre à jour la note</button>
    </form>
@endsection