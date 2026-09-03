@extends('layouts.app')
@section('title', 'Création d\'un individu')
@section('content')
    <div class="retour">
        <a href="{{ route('individus.index') }}" class="btn-index">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                fill="currentColor" viewBox="0 0 24 24">
                <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                <path d="M15 11H8v2h7v4l6-5-6-5z"></path>
                <path d="M5 21h7v-2H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"></path>
            </svg>
        </a>
        <h1>Création d'un individu</h1>
    </div>
    <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
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
            <label for="firstname">Prénom:</label>
            <input type="text" name="firstname" id="firstname" value="{{old('firstname')}}" placeholder="Entrez le prénom de l'individu" required>
            @error('firstname')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phone">Téléphone:</label>
            <input type="text" name="phone" id="phone" value="{{old('phone')}}" placeholder="Entrez le téléphone de l'individu" required>
            @error('phone')
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
        <div>
            <label for="notif_preference">Préférences de notification:</label>
            <input type="checkbox" name="notif_preference[]" value="email" {{ (is_array(old('notif_preference')) && in_array('email', old('notif_preference'))) ? 'checked' : '' }}> Email
            <input type="checkbox" name="notif_preference[]" value="sms" {{ (is_array(old('notif_preference')) && in_array('sms', old('notif_preference'))) ? 'checked' : '' }}> SMS
            <input type="checkbox" name="notif_preference[]" value="whatsapp" {{ (is_array(old('notif_preference')) && in_array('whatsapp', old('notif_preference'))) ? 'checked' : '' }}> WhatsApp
            @error('notif_preference')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" placeholder="Entrez le mot de passe" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirmer le mot de passe:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmez le mot de passe" required>
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="id_service">Service:</label>
            <select name="id_service" id="id_service" required>
                @foreach($services as $service)
                    <option value="{{ $service->id_service }}" {{ old('id_service') == $service->id_service ? 'selected' : '' }}>{{ $service->service_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="address">Adresse:</label>
            <input type="text" name="address" id="address" value="{{old('address')}}" placeholder="Entrez l'adresse de l'individu" required>
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Créer l'individu</button>
    </form>
@endsection