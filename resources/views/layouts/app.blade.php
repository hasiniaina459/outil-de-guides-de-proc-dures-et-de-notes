<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','outils de guides de procédures et de notes')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('individus.index') }}">Individus</a>
            <a href="{{ route('procedures.index') }}">Procedures</a>
            <a href="{{ route('notes.index') }}">Notes</a>
            <a href="{{ route('rappels.index') }}">Rappels</a>
        </nav>
    </header>
    <main>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>