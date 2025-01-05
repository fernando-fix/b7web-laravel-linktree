@extends('layouts.admin')

@section('header')
    <h2 class="fs-4">Meu perfil</h2>
@endsection

@section('content')
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        @include('profile.form', ['user' => $user])
    </form>
@endsection
