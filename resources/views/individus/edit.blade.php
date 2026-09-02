@extends('layouts.app')
@section('title', 'Modifier l\'individu')
@section('content')
    <h1>Modifier l'individu</h1>
    <a href="{{ route('individus.index') }}" class="btn-index">Retour à la liste des individus</a>
    <form action="{{ route('individus.update', $individus->id_individu) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $individus->name) }}" placeholder="Entrez le nom de l'individu" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="firstname">Prénom:</label>
            <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $individus->firstname) }}" placeholder="Entrez le prénom de l'individu" required>
            @error('firstname')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phone">Téléphone:</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $individus->phone) }}" placeholder="Entrez le numéro de téléphone de l'individu" required>
            @error('phone')
                <div class="error">{{ $message }}</div>
            @enderror   
        </div>
        <div>   
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $individus->email) }}" placeholder="Entrez l'email de l'individu" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" placeholder="Entrez le mot de passe de l'individu" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="address">Adresse:</label>
            <input type="text" name="address" id="address" value="{{ old('address', $individus->address) }}" placeholder="Entrez l'adresse de l'individu" required>
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="id_service">Service:</label>
            <select name="id_service" id="id_service" required>
                <option value="">Sélectionnez un service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id_service }}" {{ old('id_service', $individus->id_service) == $service->id_service ? 'selected' : '' }}>
                        {{ $service->service_name }}
                    </option>
                @endforeach
            </select>
            @error('id_service')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Mettre à jour l'individu</button>
    </form>
@endsection