<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Clone do Linktree</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @stack('styles')
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style_adm.min.css') }}">
</head>

<body>
    <div class="container-grid">
        <aside class="sidebar">
            <div class="toggle-btn" onclick="toggleSidebar()">☰</div>

            @include('layouts.menu')

            <!-- Parte do perfil (embaixo do menu) -->
            <div class="profile-info">
                <img src="https://i.pravatar.cc/60" alt="Foto de Perfil" class="profile-img">
                <div class="name">{{ explode(' ', auth()->user()->name)[0] ?? 'N/A' }}</div>
                <form action="{{ route('logout', auth()->user()->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-danger">Sair</button>
                </form>
            </div>
        </aside>
        <main class="content">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @yield('header')
                </div>

                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @stack('scripts')
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('alert.success'))
            Swal.fire({
                icon: "success",
                title: "{{ session('alert.success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @elseif (session('alert.error'))
            Swal.fire({
                icon: "error",
                title: "{{ session('alert.error') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @elseif (session('alert.warning'))
            Swal.fire({
                icon: "warning",
                title: "{{ session('alert.warning') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @elseif (session('alert.info'))
            Swal.fire({
                icon: "info",
                title: "{{ session('alert.info') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @else
            console.log("Nenhuma mensagem de alerta disponível.");
        @endif
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita o redirecionamento imediato

                    const form = this.closest('form'); // Captura o formulário mais próximo
                    const confirmMessage = this.getAttribute('data-confirm') || 'Você tem certeza?';

                    Swal.fire({
                        title: 'Confirmar ação',
                        text: confirmMessage,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar o formulário para realizar a ação de exclusão
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/script_adm.js') }}"></script>

</body>

</html>
