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

<body style="background: linear-gradient(90deg, black, darkblue);">
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
                <img src="{{ $user->image ? Storage::url($user->image) : 'https://placehold.co/100x100' }}"
                    width="100" height="100" alt="main logo">
            </div>

            <div class="header-title">
                <h1 style="color: #ffffff">{{ $user->name }}</h1>
            </div>
        </div>
    </header>

    <main>
        <section class="main-section">
            <div class="container">
                <ul class="links-list">
                    @forelse ($user->links as $link)
                        <li>
                            <a href="{{ $link->url }}" class="click-register" data-link-id="{{ $link->id }}"
                                style="background-color:#161818; color: #ffffff" target="_blank">
                                <div class="image" style="background-color: transparent;">
                                    <img src="{{ asset('assets/img/facebook.svg') }}" alt="logo" height="40"
                                        width="40">
                                </div>
                                <div class="description" title="{{ $link->description }}">{{ $link->title }}</div>
                            </a>
                        </li>
                    @empty
                        <li>
                            <div class="text-center">
                                Nenhum link cadastrado
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </section>
    </main>

    <script src="{{ asset('assets/js/bootstrap/bootstrap@5.2.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script>
        $(function() {
            $('.click-register').on('click', function() {
                const link_id = $(this).data('link-id');
                const url = $(this).attr('href');

                $.ajax({
                    url: `{{ route('click.store', ':link_id') }}`.replace(':link_id', link_id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ip: '{{ request()->ip() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        window.open(url, '_blank');
                    }
                });

                return false;
            });
        });
    </script>
</body>

</html>
