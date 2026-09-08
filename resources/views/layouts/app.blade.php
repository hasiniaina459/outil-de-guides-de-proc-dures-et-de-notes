<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','outils de guides de procédures et de notes')</title>
    <style media="print">
        nav,
        a,
        button,
        h1 {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <nav>
            <div class="menu">
                <a href="#" class="menubar" id="menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16"
                        fill="currentColor" viewBox="0 0 20 20">
                        <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                        <path d="M3 5h18v2H3zm0 6h18v2H3zm0 6h18v2H3z"></path>
                    </svg>
                </a>
            </div>
            <div class="element" id="navigation">
                <a href="{{ route('services.index') }}">Services</a>
                <a href="{{ route('individus.index') }}">Individus</a>
                <a href="{{ route('procedures.index') }}">Procedures</a>
                <a href="{{ route('notes.index') }}">Notes</a>
                <a href="{{ route('rappels.index') }}">Rappels</a>
            </div>
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
<script>
    let menu = document.getElementById('menu');
    let navy = document.getElementById('navigation')
    menu.addEventListener('click', function(e) {
        e.preventDefault();
        navy.classList.toggle('open');
    })
</script>

</html>