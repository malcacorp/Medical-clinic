<div class="bg-light p-4 rounded">
    {{-- <h2>Add new permission</h2>
        <div class="lead">
            Add new permission.
        </div> --}}

    <div class="container mt-4">
        <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" wire:model="name"
                    required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <button class="btn btn-primary" wire:click.prevent="store()">Save permission</button>
            <a class="btn btn-secondary" wire:click.prevent="handleTabs('isOpenList', 'isOpenUpdate')">{{ __('Back') }}</a>
        </form>
    </div>
</div>
