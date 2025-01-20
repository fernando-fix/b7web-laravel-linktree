<div class="form-row">

    {{-- Link --}}
    <div class="form-group mb-3 col-md-6">
        <label for="url">Link</label>
        <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url"
            value="{{ old('url', $link->url ?? null) }}">
        @error('url')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Título --}}
    <div class="form-group mb-3 col-md-6">
        <label for="title">Titulo</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="{{ old('title', $link->title ?? null) }}">
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Descrição --}}
    <div class="form-group mb-3 col-md-6">
        <label for="description">Descrição</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
            rows="3">{{ old('description', $link->description ?? null) }}</textarea>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Rede social --}}
    <div class="form-group mb-3 col-md-6">
        <label for="social_id">Rede Social</label>
        <select class="form-control @error('social_id') is-invalid @enderror" id="social_id" name="social_id">
            <option value="">Selecione uma rede social</option>
            @foreach ($socials as $social)
                <option {{ old('social_id', $link->social_id ?? null) == $social->id ? 'selected' : '' }}
                    value="{{ $social->id }}">{{ $social->title }}</option>
            @endforeach
        </select>
        @error('social_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Ativo --}}
    @isset($link)
        <div class="form-group mb-3 col-md-6">
            <label for="active">Ativo</label>
            <select class="form-control @error('active') is-invalid @enderror" id="active" name="active">
                <option {{ old('active', $link->active ?? null) == 0 ? 'selected' : '' }} value="0">Não</option>
                <option {{ old('active', $link->active ?? null) == 1 ? 'selected' : '' }} value="1">Sim</option>
            </select>
            @error('active')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    @endisset

    {{-- Botão salvar --}}
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

</div>
