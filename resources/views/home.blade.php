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

<body style="background: linear-gradient(90deg, #000000, #00008b);">
    <header>
        <div class="container">
            <div class="button-area">
                <div class="dropdown">
                    <div class="button dropdown-toggle" type="button" style="background-color:#161818; color: #ffffff"
                        data-bs-toggle="dropdown" aria-expanded="false"></div>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="dropdown-item">Cadastro</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="header-logo">
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
                <ul class="links-list">
                    <li>
                        <a href="#" style="background-color:#161818; color: #ffffff">
                            <div class="image" style="background-color: transparent;">
                                <img src="{{ asset('assets/img/facebook.svg') }}" alt="logo" height="40"
                                    width="40">
                            </div>
                            <div class="description">Quer uma página de links personalizada?</div>
                        </a>
                    </li>
                    <li>
                        <a href="#" style="background-color:#161818; color: #ffffff">
                            <div class="image" style="background-color: transparent;">
                                <img src="{{ asset('assets/img/instagram.svg') }}" alt="logo" height="40"
                                    width="40">
                            </div>
                            <div class="description">Com todos os seus links em um único lugar?</div>
                        </a>
                    </li>
                    <li>
                        <a href="#" style="background-color:#161818; color: #ffffff">
                            <div class="image" style="background-color: transparent;">
                                <img src="{{ asset('assets/img/linkedin.svg') }}" alt="logo" height="40"
                                    width="40">
                            </div>
                            <div class="description">Com as cores e estilos que você mais gosta?</div>
                        </a>
                    </li>
                    <li>
                        <a href="#" style="background-color:#161818; color: #ffffff">
                            <div class="image" style="background-color: transparent;">
                                <img src="{{ asset('assets/img/youtube.svg') }}" alt="logo" height="40"
                                    width="40">
                            </div>
                            <div class="description">Clique no botão acima e comece agora mesmo!</div>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </main>

    <script src="{{ asset('assets/js/bootstrap/bootstrap@5.2.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery-3.7.1.slim.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>

@if (old('modal_trigger'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('{{ old('modal_trigger') }}').modal('show');

            $('{{ old('tab') }}').tab('show');
        });
    </script>
@endif
