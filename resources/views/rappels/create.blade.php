@extends('layouts.app')
@section('title', 'Création d\'une note')
@section('content')
    <h1>Création d'une note</h1>
    <a href="{{ route('rappels.index') }}" class="btn-index">Retour à la liste des rappels</a>
    <form action="{{ route('rappels.store') }}" method="POST">
        @csrf
        <div>
            <label for="remind_title">Titre:</label>
            <input type="text" name="remind_title" id="remind_title" value="{{old('remind_title')}}" placeholder="Entrez le titre de la note" required>
            @error('remind_title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="remind_date">Date:</label>
            <input type="date" name="remind_date" id="remind_date" value="{{old('remind_date')}}" required>
            @error('remind_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="remind_number">Nombre de rappel:</label>
            <input type="number" name="remind_number" id="remind_number" value="{{old('remind_number')}}" placeholder="Entrez le numéro de rappel" required>
            @error('remind_number')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Créer la note</button>
    </form> 
@endsection