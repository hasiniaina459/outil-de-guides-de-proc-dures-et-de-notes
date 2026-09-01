@extends('layouts.app')
@section('title', 'Création d\'un individu')
@section('content')
<h1>Création d'un individu</h1>
<form action="{{ route('individus.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom:</label>
        <input type="text" name="name" id="name" value="{{old('name')}}" placeholder="Entrez le nom de l'individu" required>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" value="{{old('prenom')}}" placeholder="Entrez le prénom de l'individu" required>
        @error('prenom')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="telephone">Téléphone:</label>
        <input type="text" name="telephone" id="telephone" value="{{old('telephone')}}" placeholder="Entrez le téléphone de l'individu" required>
        @error('telephone')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{old('email')}}" placeholder=" Entrez l'email de l'individu" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Créer l'individu</button>
</form>
@endsection