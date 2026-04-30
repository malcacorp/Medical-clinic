<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                <x-validation-errors class="mb-4" />
                <div class="row">
                    <div class="col">
                        {{-- <div class="mb-3">
                          <img id="frame" src="" class="img-fluid mb-3" style="max-height: 200px" />
                          <input class="form-control" type="file" id="formFile" onchange="preview()">
                          {{-- <button onclick="clearImage()" class="btn btn-primary mt-3">Click me</button>
                      </div> --}}

                        <div class="mb-3" x-data="{ fileName: null, filePreview: null }">
                            <!-- Patient File Input -->
                            <input type="file" hidden wire:model="file" x-ref="file"
                                x-on:change="
                                  fileName = $refs.file.files[0].name;
                                  const reader = new FileReader();
                                  reader.onload = (e) => {
                                      filePreview = e.target.result;
                                  };
                                  reader.readAsDataURL($refs.file.files[0]);
                          " />

                            <x-label class="mb-4" for="file" value="{{ __('Patient Intake Form') }}" /><br />

                            @if ($patient!=null)
                                <!-- Current Patient File -->
                                <div class="mt-2" x-show="! filePreview">
                                    <img src="{{ asset('storage/'. $patient->patient_file_path) }}" width="400px" height="300px">
                                </div>
                            @endif

                            <!-- New Patient File Preview -->
                            <div class="mt-2" x-show="filePreview">
                                <img x-bind:src="filePreview" width="400px" height="300px">
                            </div>
                            <x-secondary-button class="mt-2 me-2" type="button"
                                x-on:click.prevent="$refs.file.click()">
                                {{ __('Select A New File') }}
                            </x-secondary-button>

                            @if ($patient!=null)
                              @if ($patient->patient_file_path)
                                  <x-secondary-button type="button" class="mt-2" wire:click="deletePatientFile">
                                      {{ __('Remove File') }}
                                  </x-secondary-button>
                              @endif
                            @endif

                            <x-input-error for="file" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="flex justify-content-center mt-4">
                    <button class="btn btn-dark text-white" wire:click.prevent="handleTabs('isOpenCreate', 'isOpenCreateTwo')"
                        type="button">
                        {{ __('Back') }}
                    </button>
                    <button class="btn btn-success text-white" wire:click.prevent="savePatientFile()"
                        type="button">
                        {{ __('Next') }}
                    </button>
                    {{-- <button class="btn btn-success text-white" wire:click.prevent="store()"
                        type="button">
                        {{ __('Save Patient') }}
                    </button> --}}
                </div>
                </div>
            </div>

        </div>
    </div>
</div>
