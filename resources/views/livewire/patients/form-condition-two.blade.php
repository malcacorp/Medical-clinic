<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                <x-validation-errors class="mb-4" />
                <div class="row">
                    <div class="col">
                        <form style="display: block">
                            @csrf
                            <input type="hidden" wire:model="patient_id">
                            <input type="hidden" wire:model="user_id">

                            <div class="row mb-4 mb-4">
                                <div class="col col-md-6 px-4">
                                    <x-label for="diagnostic" value="{{ __('Diagnostic') }}" />
                                    <select class="form-select" name="diagnostic" wire:model="diagnostic">
                                        <option value="Male" selected>High Blood Pressure</option>
                                        <option value="Female">Diabetes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col px-4">
                                    <x-label for="treatment" value="{{ __('Treatment') }}" />
                                    <textarea id="treatment"
                                        class="form-control block mt-1 w-full {{ $errors->has('treatment') ? 'is-invalid' : '' }}" type="text"
                                        name="treatment" autocomplete="treatment" wire:model="treatment">{{ old('treatment') }}</textarea>
                                </div>
                            </div>

                            <div class="flex justify-content-center mt-4">
                                <button class="btn btn-dark text-white" wire:click.prevent="handleTabs('isOpenCondition', 'isOpenConditionTwo')"
                                    type="button">
                                    {{ __('Previus') }}
                                </button>
                                <button class="btn btn-success text-white" wire:click.prevent="handleTabs('isOpenHistory', 'isOpenConditionTwo')"
                                    type="button">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
