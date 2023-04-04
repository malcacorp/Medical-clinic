<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
              {{-- <x-validation-errors class="mb-4" /> --}}
              <div class="row">
                  <div class="col col-md-10">
                      <form style="display: block">
                          @csrf
                          <input type="hidden" wire:model="employee_id">

                          <div class="row mb-4 mb-4">
                              <div class="col col-md-6 px-4">
                                  <x-label for="first_name" value="{{ __('First Name') }}" />
                                  <x-input id="first_name" class="block mt-1 w-full {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name"
                                      :value="old('first_name')" required autofocus autocomplete="first_name"
                                      wire:model="first_name" />                                    
                                  <x-input-error for="first_name"></x-input-error>
                              </div>
                              <div class="col col-md-6 px-4">
                                  <x-label for="last_name" value="{{ __('Last Name') }}" />
                                  <x-input id="last_name" class="block mt-1 w-full {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name"
                                      :value="old('last_name')" required autocomplete="last_name" wire:model="last_name" />
                                  <x-input-error for="last_name"></x-input-error>
                                </div>
                          </div>

                          <div class="row mb-4">
                              <div class="col col-md-6 px-4">
                                  <x-label for="id_number" value="{{ __('ID Number') }}" />
                                  <x-input id="id_number" class="block mt-1 w-full {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number" name="id_number"
                                      :value="old('id_number')" required autocomplete="id_number" wire:model="id_number" />
                                  <x-input-error for="id_number"></x-input-error>
                                </div>
                              <div class="col col-md-6 px-4">
                                  <x-label for="sex" value="{{ __('Sex') }}" class="{{ $errors->has('sex') ? 'is-invalid' : '' }}" />
                                  <select class="form-select" name="sex" wire:model="sex">
                                      <option value="" selected>Select...</option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
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
                                  <x-label for="birthdate" value="{{ __('Birthdate') }}" />
                                  <x-input id="birthdate" class="block mt-1 w-full {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="date" name="birthdate"
                                      :value="old('birthdate')" required autocomplete="birthdate" onkeydown="return false"
                                      wire:model="birthdate" />
                                  <x-input-error for="birthdate"></x-input-error>
                              </div>  
                              <div class="col col-md-6 px-4">
                                  <x-label for="profession" value="{{ __('Profession') }}" />
                                  <x-input id="profession" class="block mt-1 w-full {{ $errors->has('profession') ? 'is-invalid' : '' }}" type="text" name="profession"
                                      :value="old('profession')" required autocomplete="profession" wire:model="profession" />
                                  <x-input-error for="profession"></x-input-error>
                              </div>                            
                          </div>    

                          <div class="row mb-4">
                            <div class="col col-md-6 px-4">
                                <x-label for="position" value="{{ __('Position') }}" />
                                <x-input id="position" class="block mt-1 w-full {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text" name="position"
                                    :value="old('position')" required autocomplete="position" wire:model="position" />
                                <x-input-error for="position"></x-input-error>
                            </div> 
                            <div class="col col-md-6 px-4">
                                <x-label for="speciality" value="{{ __('Speciality') }}" />
                                <x-input id="speciality" class="block mt-1 w-full {{ $errors->has('speciality') ? 'is-invalid' : '' }}" type="text" name="speciality"
                                    :value="old('speciality')" required autocomplete="speciality" wire:model="speciality" />
                                <x-input-error for="speciality"></x-input-error>
                            </div>                            
                        </div>                             

                          <div class="row mb-4">
                              <div class="col px-4">
                                  <x-label for="address" value="{{ __('Address') }}" />
                                  <textarea id="address" class="form-control block mt-1 w-full {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                      type="text" name="address" autocomplete="address" wire:model="address">{{ old('address') }}</textarea>
                                  {{-- <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                              :value="old('address')" autocomplete="address" wire:model="address" /> --}}
                                  <x-input-error for="first_name"></x-input-error>
                                </div>
                          </div>

                          <div class="flex justify-content-center mt-4">
                              <button class="btn btn-dark text-white"
                                  wire:click.prevent="handleTabs('isOpenList', 'isOpenUpdate')" type="button">
                                  {{ __('Cancel') }}
                              </button>
                              
                              <button class="btn btn-success text-white" wire:click.prevent="store()"
                                  type="button">
                                  {{ __('Save Employee') }}
                              </button>
                          </div>
                      </form>
                  </div>
                  {{-- <div class="col col-md-2">
                      {{-- <div class="mb-3">
                          <img id="frame" src="" class="img-fluid mb-3" style="max-height: 200px" />
                          <input class="form-control" type="file" id="formFile" onchange="preview()">
                          {{-- <button onclick="clearImage()" class="btn btn-primary mt-3">Click me</button>
                      </div> 
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

                              @if ($employee != null)
                                  <!-- Current Profile Photo -->
                                  <div class="mt-2" x-show="! photoPreview">
                                      <img src="{{ asset('storage/' . $employee->profile_photo_path) }}"
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

                              @if ($employee != null)
                                  @if ($employee->profile_photo_path)
                                      <x-secondary-button type="button" class="mt-2"
                                          wire:click="deleteProfilePhoto">
                                          {{ __('Remove Photo') }}
                                      </x-secondary-button>
                                  @endif
                              @endif

                              <x-input-error for="photo" class="mt-2" />
                          </div>
                      @endif
                  </div> --}}
              </div>
          </div>

      </div>
  </div>
</div>
