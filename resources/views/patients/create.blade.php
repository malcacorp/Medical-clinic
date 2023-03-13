<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('patients.store') }}" style="display: block">
                        @csrf

                        <div class="flex mb-4 mb-4">
                            <div class="md:w-1/2 px-4">
                                <x-label for="first_name" value="{{ __('First Name') }}" />
                                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                    :value="old('first_name')" required autofocus autocomplete="first_name" />
                            </div>
                            <div class="md:w-1/2 px-4">
                                <x-label for="last_name" value="{{ __('Last Name') }}" />
                                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                    :value="old('last_name')" required autocomplete="last_name" />
                            </div>
                        </div>

                        <div class="flex mb-4">
                          <div class="md:w-1/2 px-4">
                              <x-label for="email" value="{{ __('Email') }}" />
                              <x-input id="email" class="block mt-1 w-full" type="text" name="email"
                                  :value="old('email')" required autocomplete="email" />
                          </div>
                          <div class="md:w-1/2 px-4">
                              <x-label for="phone_number" value="{{ __('Phone number') }}" />
                              <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                  :value="old('phone_number')" required autocomplete="phone_number" />
                          </div>
                      </div>

                      <div class="flex mb-4">
                        <div class="md:w-1/2 px-4">
                            <x-label for="birthdate" value="{{ __('Birthdate') }}" />
                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="old('birthdate')" required autocomplete="birthdate" onkeydown="return false" />
                        </div>
                        <div class="md:w-1/2 px-4">
                            <x-label for="height" value="{{ __('Height') }}" />
                            <x-input id="height" class="block mt-1 w-full" type="text" name="height"
                                :value="old('height')" autocomplete="height" />
                        </div>
                    </div>

                    <div class="flex mb-4">
                      <div class="md:w-1/2 px-4">
                          <x-label for="weight" value="{{ __('Weight') }}" />
                          <x-input id="weight" class="block mt-1 w-full" type="text" name="weight"
                              :value="old('weight')" autocomplete="weight" />
                      </div>
                      <div class="md:w-1/2 px-4">
                          <x-label for="eye_color" value="{{ __('Eye color') }}" />
                          <x-input id="eye_color" class="block mt-1 w-full" type="text" name="eye_color"
                              :value="old('eye_color')" autocomplete="eye_color" />
                      </div>
                  </div>

                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save Patient') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
