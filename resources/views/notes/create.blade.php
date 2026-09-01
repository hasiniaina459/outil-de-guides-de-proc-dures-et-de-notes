@extends('layouts.app')
@section('title', 'Création d\'une note')
@section('content')
    <h1>Création d'une note</h1>    
    <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Titre:</label>
            <input type="text" name="title" id="title" value="{{old('title')}}" placeholder="Entrez le titre de la note" required>
            @error('title')
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
            <select name="status" id="status" required>
                <option value="draft" {{ old('status') == '1' ? 'selected' : '' }}>lu</option>
                <option value="published" {{ old('status') == '0' ? 'selected' : '' }}>non lu</option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Créer la note</button>
    </form>
@endsection