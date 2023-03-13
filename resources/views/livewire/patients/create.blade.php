<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                <x-validation-errors class="mb-4" />
                <form style="display: block">
                    @csrf

                    <div class="row mb-4 mb-4">
                        <div class="col col-md-6 px-4">
                            <x-label for="first_name" value="{{ __('First Name') }}" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name')" required autofocus autocomplete="first_name"
                                wire:model="first_name" />
                        </div>
                        <div class="col col-md-6 px-4">
                            <x-label for="last_name" value="{{ __('Last Name') }}" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                :value="old('last_name')" required autocomplete="last_name" wire:model="last_name" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col col-md-6 px-4">
                            <x-label for="id_number" value="{{ __('ID Number') }}" />
                            <x-input id="id_number" class="block mt-1 w-full" type="number" name="id_number"
                                :value="old('id_number')" required autocomplete="id_number" wire:model="id_number" />
                        </div>
                        <div class="col col-md-6 px-4">
                            <x-label for="sex" value="{{ __('Sex') }}" />
                            <select class="form-select" name="sex" wire:model="sex">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>                            
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col col-md-6 px-4">
                            <x-label for="phone_number" value="{{ __('Phone number') }}" />
                            <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                :value="old('phone_number')" required autocomplete="phone_number" wire:model="phone_number" />
                        </div>
                        <div class="col col-md-6 px-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="email" wire:model="email" />
                        </div>
                    </div>

                    <div class="row mb-4">

                        <div class="col col-md-6 px-4">
                            <x-label for="birthdate" value="{{ __('Birthdate') }}" />
                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="old('birthdate')" required autocomplete="birthdate" onkeydown="return false"
                                wire:model="birthdate" />
                        </div>
                        <div class="col col-md-6 px-4">
                            <x-label for="height" value="{{ __('Height') }}" />
                            <x-input id="height" class="block mt-1 w-full" type="text" name="height"
                                :value="old('height')" autocomplete="height" wire:model="height" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col col-md-6 px-4">
                            <x-label for="weight" value="{{ __('Weight') }}" />
                            <x-input id="weight" class="block mt-1 w-full" type="text" name="weight"
                                :value="old('weight')" autocomplete="weight" wire:model="weight" />
                        </div>
                        <div class="col col-md-6 px-4">
                            <x-label for="eye_color" value="{{ __('Eye color') }}" />
                            <x-input id="eye_color" class="block mt-1 w-full" type="text" name="eye_color"
                                :value="old('eye_color')" autocomplete="eye_color" wire:model="eye_color" />
                        </div>
                    </div>

                    <div class="row mb-4">
                      <div class="col px-4">
                          <x-label for="address" value="{{ __('Address') }}" />
                          <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                              :value="old('address')" autocomplete="address" wire:model="address" />
                      </div>                      
                  </div>

                    <div class="flex justify-content-center mt-4">
                        <button class="btn btn-dark text-white" wire:click.prevent="closeModal()" type="button">
                            {{ __('Cancel') }}
                        </button>
                        <button class="btn btn-success text-white" wire:click.prevent="store()" type="button">
                            {{ __('Save Patient') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
