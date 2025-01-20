<div class="form-row">

    {{-- Imagem --}}
    <div class="form-group mb-3 col-md-6">
        <img src="{{ isset($social) && $social->image ? Storage::url($social->image) : 'https://placehold.co/150x150' }}"
            id="preview" style="max-width: 100%; max-height: 150px;" alt="Preview da imagem">
    </div>
    <div class="form-group mb-3 col-md-6">
        <label for="image">Imagem</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Título --}}
    <div class="form-group mb-3 col-md-6">
        <label for="title">Titulo</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="{{ old('title', $social->title ?? null) }}">
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Botão salvar --}}
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

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
