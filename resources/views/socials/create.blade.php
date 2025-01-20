@extends('layouts.admin')

@section('header')
    <h2 class="fs-4">Redes Sociais</h2>
    <a href="{{ route('socials.index') }}" class="btn btn-success btn-sm">
        <i class="fas fa-arrow-left"></i>
        Voltar
    </a>
@endsection
@section('content')
    <form action="{{ route('socials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        @include('socials.form')
    </form>
@endsection
