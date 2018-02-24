<form action="{{ $bin->id ? route('bins.update', ['bin' => $bin]) : route('bins.store') }}" method="post">

    @csrf

    @if($bin->id)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $bin->name ?? '' }}">
    </div>

    <button type="submit" class="btn btn-primary">{{ $bin->id ? 'Edit' : 'Create' }}</button>
</form>
