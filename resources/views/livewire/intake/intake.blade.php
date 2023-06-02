  <x-authentication-card>
      <div class="card-body">
          <h1 class="text-center my-4">{{ __('Patient Registration') }}</h1>
          <div class="row">
              @if ($isOpenMedical)
                  @include('livewire.intake.medical-condition')
              @else
                  <form>
                      @csrf
                      <input type="hidden" wire:model="patient_id">
                      <div class="row mb-2">
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="first_name" value="{{ __('First name') }}" />
                              <x-input id="first_name"
                                  class="block mt-1 w-full {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                  type="text" name="first_name" required autofocus autocomplete="first_name"
                                  wire:model="first_name" />
                              <x-input-error for="first_name"></x-input-error>
                          </div>
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="last_name" value="{{ __('Last name') }}" />
                              <x-input id="last_name"
                                  class="block mt-1 w-full {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                  type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name"
                                  wire:model="last_name" />
                              <x-input-error for="last_name"></x-input-error>
                          </div>
                      </div>

                      <div class="row mb-2">
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="id_number" value="{{ __('Id') }}" />
                              <x-input id="id_number"
                                  class="block mt-1 w-full {{ $errors->has('id_number') ? 'is-invalid' : '' }}"
                                  type="number" name="id_number" :value="old('id_number')" required autocomplete="id_number"
                                  wire:model="id_number" />
                              <x-input-error for="id_number"></x-input-error>
                          </div>
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="sex" value="{{ __('Sex') }}" />
                              <select class="form-select" name="sex" wire:model="sex">
                                  <option value="Male" selected>Male</option>
                                  <option value="Female">Female</option>
                              </select>
                          </div>
                      </div>

                      <div class="row mb-2">
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="phone_number" value="{{ __('Phone number') }}" />
                              <x-input id="phone_number"
                                  class="block mt-1 w-full {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                  type="text" name="phone_number" :value="old('phone_number')" required
                                  autocomplete="phone_number" wire:model="phone_number" />
                          </div>
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="birthdate" value="{{ __('Birthdate') }}" />
                              <x-input id="birthdate"
                                  class="block mt-1 w-full {{ $errors->has('birthdate') ? 'is-invalid' : '' }}"
                                  type="date" name="birthdate" :value="old('birthdate')" required autocomplete="birthdate"
                                  onkeydown="return false" wire:model="birthdate" />
                          </div>
                      </div>

                      <div class="row mb-2">
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="height" value="{{ __('Height') }}" />
                              <x-input id="height"
                                  class="block mt-1 w-full {{ $errors->has('height') ? 'is-invalid' : '' }}"
                                  type="text" name="height" :value="old('height')" autocomplete="height"
                                  wire:model="height" />
                          </div>
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="weight" value="{{ __('Weight') }}" />
                              <x-input id="weight"
                                  class="block mt-1 w-full {{ $errors->has('weight') ? 'is-invalid' : '' }}"
                                  type="text" name="weight" :value="old('weight')" autocomplete="weight"
                                  wire:model="weight" />
                          </div>
                      </div>

                      <div class="row mb-2">
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="eye_color" value="{{ __('Eye color') }}" />
                              <x-input id="eye_color"
                                  class="block mt-1 w-full {{ $errors->has('eye_color') ? 'is-invalid' : '' }}"
                                  type="text" name="eye_color" :value="old('eye_color')" autocomplete="eye_color"
                                  wire:model="eye_color" />
                          </div>
                          <div class="col-12 col-md-6 px-4">
                              <x-label for="address" value="{{ __('Address') }}" />
                              <textarea id="address" class="form-control block mt-1 w-full {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                  type="text" name="address" autocomplete="address" wire:model="address">{{ old('address') }}</textarea>
                          </div>
                      </div>

                      @if (!$isEdit)
                          <h2 class="text-center mt-4">{{ __('Create an user account') }}</h2>
                          <div class="mb-3 px-3">
                              <x-label value="{{ __('Email') }}" />

                              <x-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                  name="email" :value="old('email')" required wire:model="email" />
                              <x-input-error for="email"></x-input-error>
                          </div>

                          <div class="mb-3 px-3">
                              <x-label value="{{ __('Password') }}" />

                              <x-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                  name="password" :value="old('password')" required autocomplete="new-password"
                                  wire:model="password" />
                              <x-input-error for="password"></x-input-error>
                          </div>

                          <div class="mb-3 px-3">
                              <x-label value="{{ __('Confirm Password') }}" />

                              <x-input
                                  class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                  type="password" name="password_confirmation" required autocomplete="new-password"
                                  wire:model="password_confirmation" />
                              <x-input-error for="password_confirmation"></x-input-error>
                          </div>

                          @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                              <div class="mb-3">
                                  <div
                                      class="custom-control custom-checkbox px-3 {{ $errors->has('terms') ? 'is-invalid' : '' }}">
                                      <x-checkbox id="terms" name="terms" wire:model="terms" />
                                      <label class="custom-control-label" for="terms">
                                          {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                              'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '">' . __('Terms of Service') . '</a>',
                                              'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '">' . __('Privacy Policy') . '</a>',
                                          ]) !!}
                                      </label>
                                  </div>
                                  <x-input-error class="px-3" for="terms"></x-input-error>
                              </div>
                          @endif
                      @endif

                      <div class="mb-0">
                          <div class="d-flex justify-content-end align-items-baseline">
                              <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                                  {{ __('Already registered?') }}
                              </a>
                              @if ($isEdit)
                                  <button class="btn btn-success text-white" wire:click.prevent="update()"
                                      type="button">
                                      {{ __('Next') }}
                                  </button>
                              @else
                                  <button class="btn btn-success text-white" wire:click.prevent="store()"
                                      type="button">
                                      {{ __('Next') }}
                                  </button>
                              @endif
                          </div>
                      </div>
                  </form>
              @endif
          </div>
      </div>
  </x-authentication-card>
