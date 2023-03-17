<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-3" />

        <div class="card-body">
            <h1 class="text-center my-4">Patient Registration</h1>
            <div class="row">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="first_name" value="{{ __('First Name') }}" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name')" required autofocus autocomplete="first_name" />
                        </div>
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="last_name" value="{{ __('Last Name') }}" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                :value="old('last_name')" required autocomplete="last_name" />
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="id_number" value="{{ __('ID Number') }}" />
                            <x-input id="id_number" class="block mt-1 w-full" type="number" name="id_number"
                                :value="old('id_number')" required autocomplete="id_number" />
                        </div>
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="sex" value="{{ __('Sex') }}" />
                            <select class="form-select" name="sex" wire:model="sex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="phone_number" value="{{ __('Phone number') }}" />
                            <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                :value="old('phone_number')" required autocomplete="phone_number" />
                        </div>
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="birthdate" value="{{ __('Birthdate') }}" />
                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="old('birthdate')" required autocomplete="birthdate" onkeydown="return false" />
                        </div>
                    </div>

                    <div class="row mb-2">                        
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="height" value="{{ __('Height') }}" />
                            <x-input id="height" class="block mt-1 w-full" type="text" name="height"
                                :value="old('height')" autocomplete="height" />
                        </div>
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="weight" value="{{ __('Weight') }}" />
                            <x-input id="weight" class="block mt-1 w-full" type="text" name="weight"
                                :value="old('weight')" autocomplete="weight" />
                        </div>
                    </div>

                    <div class="row mb-2">                        
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="eye_color" value="{{ __('Eye color') }}" />
                            <x-input id="eye_color" class="block mt-1 w-full" type="text" name="eye_color"
                                :value="old('eye_color')" autocomplete="eye_color" />
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <textarea id="address" class="form-control block mt-1 w-full" type="text" name="address"
                                :value="old('address')" autocomplete="address" wire:model="address" >{{old('address')}}</textarea>
                        </div>
                        <div class="col-12 col-md-6 px-4">
                            <x-label for="medical_condition" value="{{ __('Medical Condition') }}" />
                            <textarea id="medical_condition" class="form-control block mt-1 w-full" type="text" name="medical_condition"
                                :value="old('medical_condition')" autocomplete="medical_condition" wire:model="medical_condition" >{{old('medical_condition')}}</textarea>
                        </div>
                    </div>
                  
                    <h2 class="text-center mt-4">Create an user</h2>
                    <div class="mb-3 px-3">
                        <x-label value="{{ __('Email') }}" />

                        <x-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                            :value="old('email')" required />
                        <x-input-error for="email"></x-input-error>
                    </div>

                    <div class="mb-3 px-3">
                        <x-label value="{{ __('Password') }}" />

                        <x-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                            name="password" :value="old('password')" required autocomplete="new-password" />
                        <x-input-error for="password"></x-input-error>
                    </div>

                    <div class="mb-3 px-3">
                        <x-label value="{{ __('Confirm Password') }}" />

                        <x-input class="form-control" type="password" name="password_confirmation" required
                            autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mb-3">
                            <div class="custom-control custom-checkbox px-3">
                                <x-checkbox id="terms" name="terms" />
                                <label class="custom-control-label" for="terms">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '">' . __('Terms of Service') . '</a>',
                                        'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '">' . __('Privacy Policy') . '</a>',
                                    ]) !!}
                                </label>
                            </div>
                        </div>
                    @endif

                    <div class="mb-0">
                        <div class="d-flex justify-content-end align-items-baseline">
                            <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button>
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
