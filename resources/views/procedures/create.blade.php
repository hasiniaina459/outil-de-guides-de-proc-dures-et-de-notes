@extends('layouts.app')
@section('title', 'Création d\'une procédure')
@section('content')
    <h1>Création d\'une procédure</h1>
    <form action="{{ route('procedures.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" value="{{old('name')}}" placeholder="Entrez le nom de la procédure" required>
            @error('name')
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
            <select name="status" id="status" required>
                <option value="draft" {{ old('status') == '1' ? 'selected' : '' }}>effectuer</option>
                <option value="published" {{ old('status') == '0' ? 'selected' : '' }}>non effectuer</option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit">Créer la procédure</button>
</form>
@endsection