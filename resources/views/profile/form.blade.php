{{-- Imagem --}}

<div class="form-group mb-3 col-md-6">
    <img src="{{ $user->image ? Storage::url($user->image) : 'https://placehold.co/150x150' }}" id="preview"
        style="max-width: 100%; max-height: 150px;" alt="Preview da imagem">
</div>
<div class="form-group mb-3 col-md-6">
    <label for="image">Imagem</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
    @error('image')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- NomeDeUsuário --}}
<div class="form-group mb-3 col-md-6">
    <label for="username">Nome de Usuário</label>
    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
        value="{{ old('username', $user->username ?? null) }}" disabled>
</div>

{{-- Meu link --}}
<div class="form-group mb-3 col-md-6">
    <div class="input-group ">
        <input type="text" class="form-control" value="{{ route('profile', $user->slug) }}" disabled id="link">
        <div class="input-group-text bg-light" role="button" id="copyLink">
            <i class="far fa-copy"></i>
        </div>
    </div>
</div>

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

@push('scripts')
    <script>
        const inputImage = document.getElementById('image');
        const preview = document.getElementById('preview');

        inputImage.addEventListener('change', () => {
            const file = inputImage.files[0];
            const reader = new FileReader();

            preview.src = 'https://i.giphy.com/3oEjI6SIIHBdRxXI40.webp';
            setTimeout(() => {
                reader.onload = () => {
                    preview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }, 1000);
        });

        let copyLink = document.getElementById('copyLink');
        copyLink.addEventListener('click', () => {
            let link = document.getElementById('link');
            navigator.clipboard.writeText(link.value).then(function() {
                console.log('Link copiado com sucesso!');
            }, function(err) {
                console.error('Erro ao copiar o link:', err);
            });
            Swal.fire({
                icon: "success",
                title: "Link copiado!",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endpush
