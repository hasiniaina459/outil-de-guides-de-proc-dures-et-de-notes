@extends('layouts.app')
@section('title', 'Création d\'une note')
@section('content')
    <h1>Création d'une note</h1>    
    <a href="{{ route('notes.index') }}" class="btn-index">Retour à la liste des notes</a>
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
                <option value="draft" {{ old('note_status') == '1' ? 'selected' : '' }}>lu</option>
                <option value="published" {{ old('note_status') == '0' ? 'selected' : '' }}>non lu</option>
            </select>
            @error('note_status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Créer la note</button>
    </form>
@endsection