@extends('layouts.app')
@section('title', 'Modifier la rappel')
@section('content')
    <h1>Modifier la rappel</h1>
    <a href="{{ route('rappels.index') }}" class="btn-index">Retour à la liste des rappels</a>
    <form action="{{ route('rappels.update', $rappels->id_rappel) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="remind_title">Titre:</label>
            <input type="text" name="remind_title" id="remind_title" value="{{ old('remind_title', $rappels->remind_title) }}" placeholder="Entrez le titre de la rappel" required>
            @error('remind_title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="remind_date">Date:</label>
            <input type="date" name="remind_date" id="remind_date" value="{{ old('remind_date', $rappels->remind_date) }}" required>
            @error('remind_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="remind_number">nombre de rappels:</label>
            <input type="number" name="remind_number" id="remind_number" value="{{ old('remind_number', $rappels->remind_number) }}" required>
            @error('remind_number')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Mettre à jour la rappel</button>
    </form>
@endsection