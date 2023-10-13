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
                           
                            <div class="row mb-4">
                                <div class="col px-4">
                                    <x-label for="previous_illnesses" value="{{ __('Previous illnesses') }}" />
                                    <textarea id="previous_illnesses" class="form-control block mt-1 w-full {{ $errors->has('previous_illnesses') ? 'is-invalid' : '' }}"
                                        type="text" name="previous_illnesses" autocomplete="previous_illnesses" wire:model="previous_illnesses">{{ old('previous_illnesses') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col px-4">
                                    <x-label for="diagnostic" value="{{ __('Diagnostic') }}" />
                                    <textarea id="diagnostic" class="form-control block mt-1 w-full {{ $errors->has('diagnostic') ? 'is-invalid' : '' }}"
                                        type="text" name="diagnostic" autocomplete="diagnostic" wire:model="diagnostic">{{ old('diagnostic') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col px-4">
                                    <x-label for="treatment" value="{{ __('Treatment') }}" />
                                    <textarea id="treatment" class="form-control block mt-1 w-full {{ $errors->has('treatment') ? 'is-invalid' : '' }}"
                                        type="text" name="treatment" autocomplete="treatment" wire:model="treatment">{{ old('treatment') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col px-4">
                                    <x-label for="active_assessment" value="{{ __('Finish Assessment?') }}" />
                                    <select class="form-select" name="active_assessment" wire:model="active_assessment" required>
                                        <option value=1 selected>No</option>
                                        <option value=0>Si</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex justify-content-center mt-4">
                                <button class="btn btn-dark text-white"
                                    wire:click.prevent="handleTabs('isOpenCondition', 'isOpenConditionTwo')"
                                    type="button">
                                    {{ __('Back') }}
                                </button>
                                <button class="btn btn-success text-white"
                                    wire:click.prevent="handleTabs('isOpenHistories', 'isOpenConditionTwo', 'updateAssessment')"
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
