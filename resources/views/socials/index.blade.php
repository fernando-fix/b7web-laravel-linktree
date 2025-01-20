@extends('layouts.admin')

@section('header')
    <h2 class="fs-4">socials</h2>
    <a href="{{ route('socials.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i>
        Cadastrar nova rede social
    </a>
@endsection
@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th width="1">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($socials as $social)
                <tr class="align-middle">
                    <td>
                        <img src="{{ $social->image ? Storage::url($social->image) : 'https://placehold.co/150x150' }}"
                            style="max-width: 100%; max-height: 50px;" alt="{{ $social->title }}">
                    </td>
                    <td>{{ $social->title }}</td>
                    <td style="white-space: nowrap">
                        <a href="{{ route('socials.edit', $social->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('socials.destroy', $social->id) }}" method="POST" class="d-inline">
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
                    <td colspan="100%">Nenhum social cadastrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
