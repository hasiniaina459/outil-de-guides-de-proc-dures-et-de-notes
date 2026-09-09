<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/connexion.css') }}">
    <title>login</title>
</head>

<body>
    <form method="POST" action="{{route('login')}}">
        @csrf
        <h1>login</h1>
        <Label>Email</Label>
        <input type="email" name="email" value="{{old('email')}}" required>
        @error('email')
            <p>{{$message}}</p>
        @enderror
        <label>Mot de passe</label>
        <input type="password" name="password" required>
        @error('password')
            <p>{{$message}}</p>
        @enderror
        <a href="{{route('individus.create')}}">créer</a>
        <button type="submit">connexion</button>
    </form>
</body>

</html>