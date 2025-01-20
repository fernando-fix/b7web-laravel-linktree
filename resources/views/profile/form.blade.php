<div class="row">
    {{-- Coluna 01 --}}
    <div class="col-lg-6">
        {{-- Imagem --}}
        <div class="form-group mb-3">
            <img src="{{ $user->image ? Storage::url($user->image) : 'https://placehold.co/150x150' }}" id="preview"
                style="max-width: 100%; max-height: 150px;" alt="Preview da imagem">
        </div>
        <div class="form-group mb-3">
            <label for="image">Imagem</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                name="image">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- NomeDeUsuário --}}
        <div class="form-group mb-3">
            <label for="username">Nome de Usuário</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                name="username" value="{{ old('username', $user->username ?? null) }}" disabled>
        </div>

        {{-- Meu link --}}
        <div class="form-group mb-3">
            <div class="input-group ">
                <input type="text" class="form-control" value="{{ route('profile', $user->slug) }}" disabled
                    id="link">
                <div class="input-group-text bg-light" role="button" id="copyLink">
                    <i class="far fa-copy"></i>
                </div>
            </div>
        </div>

        {{-- Tema --}}
        <div class="form-group mb-3">
            <label for="theme_id">Tema</label>
            <select class="form-control @error('theme_id') is-invalid @enderror" id="theme_id" name="theme_id">
                <option value="">Selecione um tema</option>
                @foreach ($themes as $theme)
                    <option value="{{ $theme->id }}"
                        {{ old('theme_id', $user->theme_id ?? null) == $theme->id ? 'selected' : '' }}>
                        {{ $theme->title }}
                    </option>
                @endforeach
            </select>
            @error('theme_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Nome --}}
        <div class="form-group mb-3">
            <label for="name">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $user->name ?? null) }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Senha --}}
        <div class="form-group mb-3">
            <label for="password">Senha</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Confirmar Senha --}}
        <div class="form-group mb-3">
            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        {{-- Botão salvar --}}
        <div class="form-group col-md-12 d-flex justify-content-center justify-content-lg-start mb-4">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
    {{-- Coluna 02 --}}
    <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <div class="phone"
            style="
            background-image: linear-gradient(
                {{ $user->theme->angle }}deg,
                {{ $user->theme->bg_color1 }},
                {{ $user->theme->bg_color2 }}
            );
            ">
            <div class="phone-inner"
                style="
                background-image: url({{ asset('assets/img/phone.webp') }});
                color: {{ $user->theme->font_color }};
                ">
                <ul class="links-list">
                    <div class="header-logo text-center">
                        <img src="{{ $user->image ? Storage::url($user->image) : 'https://placehold.co/100x100' }}"
                            width="100" height="100" alt="main logo">
                    </div>
                    @foreach ($user->links as $key => $link)
                        <li>
                            <a href="#" style="background-color:{{ $user->theme->btn_color }}; color: {{ $user->theme->text_color }}">
                                <div class="image" style="background-color: transparent;">
                                    <img src="{{ $link->social->image ? Storage::url($link->social->image) : 'https://placehold.co/40x40' }}" alt="logo" height="40"
                                        width="40">
                                </div>
                                <div class="description">{{ $link->title }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
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

@push('styles')
    <style>
        .phone {
            padding: 10px;
            position: relative;
            width: 350px;
            height: 730px;
        }

        .phone-inner {
            height: 100%;
            position: absolute;
            background-size: cover;
            background-position: center;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 18px;
            padding-top: 12%;
            padding-left: 4%;
            padding-right: 4%;
            padding-bottom: 20%;
        }

        .header-logo img{
            border-radius: 50%;
        }

        .links-list {
            position: relative;
            margin-top: 40px;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding-bottom: 32px;
            padding-left: 0;
            height: 100%;
            overflow-y: auto;
        }

        .links-list::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        .links-list::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px;
        }

        .links-list::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .links-list::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .links-list li a {
            min-height: 70px;
            display: flex;
            align-items: center;
            font-size: 18px;
            border-radius: 10px;
            text-decoration: none;
            margin-left: 10px;
            margin-right: 10px;
            transition: all 0.3s ease;
            padding-left: 20px;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .links-list li a:hover {
            transform: scale(1.05);
        }

        .links-list li a .image {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .links-list li a .image img {
            transition: all 0.3s ease;
        }

        .links-list li a .description {
            display: flex;
            width: 100%;
            justify-content: center;
        }
    </style>
@endpush
