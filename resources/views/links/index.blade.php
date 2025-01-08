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
                <th>Nome</th>
                <th>URL</th>
                <th>Descrição</th>
                <th>Clicks</th>
                <th width="1">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($links as $link)
                <tr>
                    <td>{{ $link->title }}</td>
                    <td>{{ $link->url }}</td>
                    <td>{{ Str::limit($link->description, 50) }}</td>
                    <td>{{ sizeof($link->clicks) }}</td>
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
