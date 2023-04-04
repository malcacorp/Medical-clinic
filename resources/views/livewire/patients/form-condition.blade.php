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
                            <input type="hidden" wire:model="assessment_id">

                            <div class="row mb-4 mb-4">
                                <div class="col col-md-3 px-4">
                                    <x-label for="height" value="{{ __('Height') }}" />
                                    <x-input id="height" class="block mt-1 w-full" type="text" name="height"
                                        :value="old('height')" autocomplete="height" wire:model="height" />
                                </div>
                                <div class="col col-md-3 px-4">
                                    <x-label for="weight" value="{{ __('Weight') }}" />
                                    <x-input id="weight" class="block mt-1 w-full" type="text" name="weight"
                                        :value="old('weight')" autocomplete="weight" wire:model="weight" />
                                </div>
                                <div class="col col-md-3 px-4">
                                    <x-label for="temperature" value="{{ __('Temperature') }}" />
                                    <x-input id="temperature" class="block mt-1 w-full" type="text"
                                        name="temperature" :value="old('temperature')" autocomplete="temperature"
                                        wire:model="temperature" />
                                </div>
                                <div class="col col-md-3 px-4">
                                    <x-label for="blood_pressure" value="{{ __('Pressure') }}" />
                                    <x-input id="blood_pressure" class="block mt-1 w-full" type="text" name="blood_pressure"
                                        :value="old('blood_pressure')" autocomplete="blood_pressure" wire:model="blood_pressure" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col px-4">
                                    <x-label for="medical_condition" value="{{ __('Medical Condition') }}" />
                                    <textarea id="medical_condition"
                                        class="form-control block mt-1 w-full {{ $errors->has('medical_condition') ? 'is-invalid' : '' }}" type="text"
                                        name="medical_condition" autocomplete="medical_condition" wire:model="medical_condition">{{ old('medical_condition') }}</textarea>
                                </div>
                            </div>

                            <div class="flex justify-content-center mt-4">
                                <button class="btn btn-dark text-white" wire:click.prevent="handleTabs('isOpenCreateTwo', 'isOpenCondition')"
                                    type="button">
                                    {{ __('Previus') }}
                                </button>
                                <button class="btn btn-success text-white" wire:click.prevent="handleTabs('isOpenConditionTwo', 'isOpenCondition', 'updateAssessment')"
                                    type="button">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
