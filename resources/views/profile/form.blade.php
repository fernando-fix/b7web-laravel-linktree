{{-- Nome --}}
<div class="form-group mb-3 col-md-6">
    <label for="name">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $user->name ?? null) }}">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- Senha --}}
<div class="form-group mb-3 col-md-6">
    <label for="password">Senha</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- Confirmar Senha --}}
<div class="form-group mb-3 col-md-6">
    <label for="password_confirmation">Confirmar Senha</label>
    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
        id="password_confirmation" name="password_confirmation">
    @error('password_confirmation')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- Botão salvar --}}
<div class="form-group col-md-12">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
