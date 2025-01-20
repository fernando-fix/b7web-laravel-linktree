@extends('layouts.admin')

@section('header')
    <h2 class="fs-4">Links</h2>
    <a href="{{ route('links.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i>
        Cadastrar novo link
    </a>
@endsection
@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ordem</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>URL</th>
                <th>Descrição</th>
                <th>Clicks</th>
                <th>Ativo</th>
                <th width="1">Ações</th>
            </tr>
        </thead>
        <tbody id="sortable-table">
            @forelse($links as $link)
                <tr class="align-middle" data-id="{{ $link->id }}">
                    <td class="drag-handle" style="cursor: move"><i class="fas fa-arrows-alt"></i></td>
                    <td>
                        <img src="{{ $link->social->image ? Storage::url($link->social->image) : 'https://placehold.co/40x40' }}" alt="{{ $link->title }}" width="40" height="40">
                    </td>
                    <td>{{ $link->title }}</td>
                    <td>{{ $link->url }}</td>
                    <td>{{ Str::limit($link->description, 50) }}</td>
                    <td>{{ sizeof($link->clicks) }}</td>
                    <td>
                        @if ($link->active == 1)
                            <i class="fas fa-check text-success"></i>
                        @else
                            <i class="fas fa-times text-danger"></i>
                        @endif
                    </td>
                    <td style="white-space: nowrap">
                        <a href="{{ route('links.edit', $link->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('links.destroy', $link->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm btn-delete" title="Excluir" type="submit"
                                data-confirm="Tem certeza que deseja excluir este item?">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%">Nenhum link cadastrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('sortable-table');
            const sortable = new Sortable(table, {
                handle: '.drag-handle', // Alvo para arrastar
                animation: 150, // Suavidade da movimentação
                onEnd: function (event) {
                    // Obtém a nova ordem dos itens
                    const orderedIds = Array.from(table.querySelectorAll('tr')).map(row => row.dataset.id);

                    // Envia para o servidor via AJAX
                    fetch('{{ route('links.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ order: orderedIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Ordem atualizada com sucesso');
                        } else {
                            console.error('Erro ao atualizar a ordem');
                        }
                    });
                },
            });
        });
    </script>

@endpush
