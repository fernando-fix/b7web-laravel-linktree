@extends('layouts.admin')

@section('header')
    <h2 class="fs-4">Links</h2>
    <a href="{{ route('links.index') }}" class="btn btn-success btn-sm">
        <i class="fas fa-arrow-left"></i>
        Voltar
    </a>
@endsection
@section('content')
    <form action="{{ route('links.update', $link->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('links.form')
    </form>
@endsection
