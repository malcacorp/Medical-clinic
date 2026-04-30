<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
              {{-- <x-validation-errors class="mb-4" /> --}}
              <div class="row">
                <div class="col col-md-4  text-end">
                  @if ($positionPage>0)    
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        {!! __('pagination.previous') !!}
                    </button>
                  @endif
                </div>
                <div class="col col-md-4 text-center">
                  <h2>{{ __('Date') }}: <strong>{{$historyToShow->date}}</strong></h2>
                </div>
                <div class="col col-md-4">
                  @if (($positionPage+1)<$totalPatientHistories)
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                      {!! __('pagination.next') !!}
                    </button>
                  @endif
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col">
                  <h3>Doctor: <strong>{{$historyToShow->doctorName ? $historyToShow->doctorName : null}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Patient`s Medical Condition') }} : <strong>{{$historyToShow->diagnostic}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Treatment and Prescription') }}: <strong>{{$historyToShow->treatment}}</strong></h3>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col">
                  <h3>Nurse: <strong>{{$historyToShow->nurseName ? $historyToShow->nurseName : null}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Initial Medical Condition') }} : <strong>{{$historyToShow->medical_condition}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Blood Pressure') }}: <strong>{{$historyToShow->blood_pressure}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Temperature') }}: <strong>{{$historyToShow->temperature}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Weight') }}: <strong>{{$historyToShow->weight}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Height') }}: <strong>{{$historyToShow->height}}</strong></h3>
                </div>
              </div>
              <hr>
              <div class="flex justify-content-center mt-4">
                <button class="btn btn-dark text-white"
                    wire:click.prevent="handleTabs('isOpenHistories', 'isShowHistory')" type="button">
                    {{ __('Back') }}
                </button>
                <button class="btn btn-dark text-white"
                    wire:click.prevent="handleTabs('isOpenHistories', 'isShowHistory')" type="button">
                    {{ __('Edit') }}
                </button>              
             </div>
          </div>
      </div>
  </div>
</div>
