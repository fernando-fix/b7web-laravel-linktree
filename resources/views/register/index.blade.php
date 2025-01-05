<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Clone do Linktree</title>
    <meta charset="UTF-8">
    <meta name="description" content="Clone do Linktree da B7WEB">
    <meta name="keywords" content="Linktree, B7WEB, Curso">
    <meta name="author" content="Fernando Rodrigues">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap@5.2.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
</head>

<body class="pt-3" style="background: linear-gradient(90deg, black, darkblue);">
    <header>
        <div class="container">

            <div class="header-logo mt-3">
                <img src="{{ asset('assets/img/_logo.svg') }}" alt="main logo">
            </div>

            <div class="header-title">
                <h1 style="color: #ffffff">Clone do Linktree</h1>
            </div>
        </div>
    </header>

    <main>
        <section class="main-section">
            <div class="container">
                <form class="mt-3 text-light" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    @include('register.form')
                </form>
            </div>
        </section>
    </main>

    <script src="{{ asset('assets/js/bootstrap/bootstrap@5.2.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery-3.7.1.slim.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
