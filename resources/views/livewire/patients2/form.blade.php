<div class="card" style="border-radius: 16px; overflow: hidden; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.07);">
    <div class="card-header d-flex align-items-center gap-2 py-3 px-4" style="border-bottom: 1px solid #f3f4f6; background: #fff;">
        <div style="width:4px; height:24px; background: linear-gradient(180deg,#b91c1c,#7f1d1d); border-radius:3px;"></div>
        <span style="font-size:0.85rem; font-weight:700; color:#374151; text-transform:uppercase; letter-spacing:0.06em;">
            <i class="fas fa-user me-2 text-danger"></i>{{ __('Información del Paciente') }}
        </span>
    </div>
    <div class="card-body p-4">
        {{-- <x-validation-errors class="mb-4" /> --}}
        <div class="row">

                    <div class="col col-md-10">
                        <form style="display: block">
                            @csrf
                            <input type="hidden" wire:model="patient_id">
                            <input type="hidden" wire:model="user_id">

                            <div class="row mb-4 mb-4">
                                <div class="col col-md-6 px-4">
                                    <x-label for="first_name" value="{{ __('First name') }} *" />
                                    <x-input id="first_name" class="block mt-1 w-full {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name"
                                        :value="old('first_name')" required autofocus autocomplete="first_name"
                                        wire:model="first_name" />                                    
                                    <x-input-error for="first_name"></x-input-error>
                                </div>
                                <div class="col col-md-6 px-4">
                                    <x-label for="last_name" value="{{ __('Last name') }} *" />
                                    <x-input id="last_name" class="block mt-1 w-full {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name"
                                        :value="old('last_name')" required autocomplete="last_name" wire:model="last_name" />
                                    <x-input-error for="last_name"></x-input-error>
                                  </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col col-md-6 px-4">
                                    <x-label for="id_number" value="{{ __('Id Number') }} *" />
                                    <x-input id="id_number" class="block mt-1 w-full {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number" name="id_number"
                                        :value="old('id_number')" required autocomplete="id_number" wire:model="id_number" />
                                    <x-input-error for="id_number"></x-input-error>
                                  </div>
                                <div class="col col-md-6 px-4">
                                    <x-label for="sex" value="{{ __('Sex') }} *" class="{{ $errors->has('sex') ? 'is-invalid' : '' }}" />
                                    <select class="form-select" name="sex" wire:model="sex">
                                        <option value="" selected>{{ __('Select') }}...</option>
                                        <option value="Male">{{ __('Male') }}</option>
                                        <option value="Female">{{ __('Female') }}</option>
                                    </select>
                                    <x-input-error for="sex"></x-input-error>
                                  </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col col-md-6 px-4">
                                    <x-label for="phone_number" value="{{ __('Phone number') }}" />
                                    <x-input id="phone_number" class="block mt-1 w-full {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text"
                                        name="phone_number" :value="old('phone_number')" required autocomplete="phone_number"
                                        wire:model="phone_number" />
                                    <x-input-error for="phone_number"></x-input-error>
                                  </div>
                                <div class="col col-md-6 px-4">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                        :value="old('email')" required autocomplete="email" wire:model="email" />
                                    <x-input-error for="email"></x-input-error>
                                  </div>
                            </div>

                            <div class="row mb-4">

                                <div class="col col-md-6 px-4">
                                    <x-label for="birthdate" value="{{ __('Birthdate') }} *" />
                                    <x-input id="birthdate" class="block mt-1 w-full {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="date" name="birthdate"
                                        :value="old('birthdate')" required autocomplete="birthdate"
                                        wire:model="birthdate" />
                                    <x-input-error for="birthdate"></x-input-error>
                                  </div>
                                <div class="col col-md-6 px-4">
                                    <x-label for="height" value="{{ __('Height') }} *" />
                                    <x-input id="height" class="block mt-1 w-full {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" min="1" step="0.01" name="height"
                                        :value="old('height')" autocomplete="height" wire:model="height" />
                                    <x-input-error for="height"></x-input-error>
                                  </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col col-md-6 px-4">
                                    <x-label for="weight" value="{{ __('Weight') }} *" />
                                    <x-input id="weight" class="block mt-1 w-full {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" min="1" step="0.01" name="weight"
                                        :value="old('weight')" autocomplete="weight" wire:model="weight" />
                                    <x-input-error for="weight"></x-input-error>
                                  </div>
                                <div class="col col-md-6 px-4">
                                    <x-label for="eye_color" value="{{ __('Eye color') }}" />
                                    <x-input id="eye_color" class="block mt-1 w-full {{ $errors->has('eye_color') ? 'is-invalid' : '' }}" type="text"
                                        name="eye_color" :value="old('eye_color')" autocomplete="eye_color"
                                        wire:model="eye_color" />
                                    <x-input-error for="eye_color"></x-input-error>
                                  </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col px-4">
                                    <x-label for="address" value="{{ __('Address') }} *" />
                                    <textarea id="address" class="form-control block mt-1 w-full {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        type="text" name="address" autocomplete="address" wire:model="address">{{ old('address') }}</textarea>
                                    {{-- <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old('address')" autocomplete="address" wire:model="address" /> --}}
                                    <x-input-error for="address"></x-input-error>
                                  </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #f3f4f6;">
                                <button class="btn btn-outline-secondary"
                                    wire:click.prevent="redirectToRoute('patients2')" type="button">
                                    <i class="fas fa-times me-1"></i> {{ __('Cancelar') }}
                                </button>
                                <button class="btn btn-danger text-white"
                                    wire:click.prevent="handleTabs('isOpenCreateTwo', 'isOpenCreate','store');"
                                    type="button">
                                    {{ __('Siguiente') }} <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col col-md-2">
                        {{-- <div class="mb-3">
                            <img id="frame" src="" class="img-fluid mb-3" style="max-height: 200px" />
                            <input class="form-control" type="file" id="formFile" onchange="preview()">
                            {{-- <button onclick="clearImage()" class="btn btn-primary mt-3">Click me</button>
                        </div> --}}
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="mb-3" x-data="{ photoName: null, photoPreview: null }">
                                <!-- Profile Photo File Input -->
                                <input type="file" hidden wire:model="photo" x-ref="photo"
                                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                                <x-label for="photo" value="{{ __('Photo') }}" />

                                @if ($user != null)
                                    <!-- Current Profile Photo -->
                                    <div class="mt-2" x-show="! photoPreview">
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                            class="rounded-circle" height="200px" width="200px">
                                    </div>
                                @endif

                                <!-- New Profile Photo Preview -->
                                <div class="mt-2" x-show="photoPreview">
                                    <img x-bind:src="photoPreview" class="rounded-circle" width="200px"
                                        height="200px">
                                </div>
                                <x-secondary-button class="mt-2 me-2" type="button"
                                    x-on:click.prevent="$refs.photo.click()">
                                    {{ __('Select A New Photo') }}
                                </x-secondary-button>

                                @if ($user != null)
                                    @if ($user->profile_photo_path)
                                        <x-secondary-button type="button" class="mt-2"
                                            wire:click="deleteProfilePhoto">
                                            {{ __('Remove Photo') }}
                                        </x-secondary-button>
                                    @endif
                                @endif

                                <x-input-error for="photo" class="mt-2" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
