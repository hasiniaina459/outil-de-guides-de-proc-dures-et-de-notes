@extends('layouts.app')
@section('title', 'Création d\'une note')
@section('content')
<div class="retour">
    <a href="{{ route('rappels.index') }}" class="btn-index">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            fill="currentColor" viewBox="0 0 24 24">
            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
            <path d="M15 11H8v2h7v4l6-5-6-5z"></path>
            <path d="M5 21h7v-2H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"></path>
        </svg>
    </a>
    <h1>Création d'un rappel</h1>
</div>
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
        <label for="id_individu">destinataire</label>
        <select name="individu[]" id="individu" multiple size="6" required>
            @foreach($individus as $individu)
                <option value="{{ $individu->id_individu }}" 
                {{in_array($individu->id_indinvidu, old('individu', [])) ? 'selected' : '' }}>{{ $individu->name }}</option>
            @endforeach
        </select>
        @error('individu')
                <div class="error">{{ $message }}</div>
        @enderror
        @error('individu.*')
                <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Créer la note</button>
</form>
@endsection