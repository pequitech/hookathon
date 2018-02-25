<form action="{{ $bin->id ? route('bins.update', ['bin' => $bin]) : route('bins.store') }}" method="post">

    @csrf

    @if($bin->id)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') ?? $bin->name ?? '' }}">

        @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $bin->id ? 'Edit' : 'Create' }}</button>
</form>
