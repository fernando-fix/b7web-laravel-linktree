<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
        value="{{ old('email') }}">
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="password" class="form-label">Senha</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
<button type="submit" class="btn btn-primary">Entrar</button>
