@extends('layouts.admin')

@section('header')
    <h2 class="fs-4">Meu perfil</h2>
    {{-- link para acessar o perfil --}}
    <a href="{{ route('profile', Auth::user()->slug) }}" target="_blank" class="btn btn-secondary btn-sm">
        <i class="fas fa-home"></i>
        Perfil
    </a>
@endsection

@section('content')
    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('profile.form', ['user' => $user])
    </form>
@endsection
