<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name') }}">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="username" class="form-label">Nome de Usuário</label>
    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
        value="{{ old('username') }}">
    @error('username')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
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
<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar
        Senha</label>
    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
        id="password_confirmation" name="password_confirmation">
    @error('password_confirmation')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
<button type="submit" class="btn btn-primary">Cadastrar</button>
