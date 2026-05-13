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
                  <h3>Patients's {{ __('Medical Condition') }} : <strong>{{$historyToShow->diagnostic}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>{{ __('Treatment') }} and Prescription: <strong>{{$historyToShow->treatment}}</strong></h3>
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
                  <h3>{{ __('Initial') }} {{ __('Medical Condition') }} : <strong>{{$historyToShow->medical_condition}}</strong></h3>
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
              @if($historyToShow->fur || $historyToShow->gestas !== null)
              <hr>
              <h3 class="text-primary">{{ __('Gynecology History') }}</h3>
              <div class="row">
                <div class="col-md-4"><strong>FUR:</strong> {{$historyToShow->fur}}</div>
                <div class="col-md-4"><strong>Menarquia:</strong> {{$historyToShow->menarquia}}</div>
                <div class="col-md-4"><strong>Ciclos:</strong> {{$historyToShow->cycles}}</div>
              </div>
              <div class="row">
                <div class="col-md-4"><strong>Vida Sexual Activa:</strong> {{$historyToShow->sexual_activity ? 'Si' : 'No'}}</div>
                <div class="col-md-4"><strong>Coitarche:</strong> {{$historyToShow->coitarche}}</div>
                <div class="col-md-4"><strong>Parejas:</strong> {{$historyToShow->partners}}</div>
              </div>
              <div class="row">
                <div class="col-md-6"><strong>Anticonceptivo:</strong> {{$historyToShow->contraceptive}}</div>
                <div class="col-md-3"><strong>Papanicolaou:</strong> {{$historyToShow->papanicolaou}}</div>
                <div class="col-md-3"><strong>Mamografía:</strong> {{$historyToShow->mammography}}</div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <strong>Obstétricos:</strong> 
                  G:{{$historyToShow->gestas}} | P:{{$historyToShow->partos}} | C:{{$historyToShow->cesareas}} | A:{{$historyToShow->abortos}} | E:{{$historyToShow->ectopicos}}
                </div>
              </div>
              <div class="row">
                <div class="col"><strong>Último Parto:</strong> {{$historyToShow->last_delivery}}</div>
              </div>
              <div class="row">
                <div class="col"><strong>Complicaciones:</strong> {{$historyToShow->obstetric_complications}}</div>
              </div>
              <div class="row mt-2">
                <div class="col"><strong>Examen Físico Ginecológico:</strong> {{$historyToShow->physical_exam_gyneco}}</div>
              </div>
              <div class="row">
                <div class="col"><strong>Plan de Manejo:</strong> {{$historyToShow->management_plan}}</div>
              </div>
              <div class="row">
                <div class="col"><strong>Exámenes Solicitados:</strong> {{$historyToShow->requested_exams}}</div>
              </div>
              @endif
              @if($historyToShow->maternal_age || $historyToShow->gestas_ped !== null)
              <hr>
              <h3 class="text-primary">{{ __('Pediatrics History') }}</h3>
              <div class="row">
                <div class="col-md-3"><strong>Edad materna:</strong> {{$historyToShow->maternal_age}}</div>
                <div class="col-md-3"><strong>Gestas:</strong> {{$historyToShow->gestas_ped}}</div>
                <div class="col-md-3"><strong>Paras:</strong> {{$historyToShow->paras}}</div>
                <div class="col-md-3"><strong>Abortos:</strong> {{$historyToShow->abortos_ped}}</div>
              </div>
              <div class="row">
                <div class="col-md-4"><strong>Embarazo controlado:</strong> {{$historyToShow->controlled_pregnancy ? 'Si' : 'No'}}</div>
                <div class="col-md-4"><strong>Consultas:</strong> {{$historyToShow->consultations_count}}</div>
                <div class="col-md-4"><strong>Semanas Gest.:</strong> {{$historyToShow->gestational_weeks}}</div>
              </div>
              <div class="row mt-2">
                <div class="col"><strong>Complicaciones embarazo:</strong> {{$historyToShow->pregnancy_complications}}</div>
              </div>
              <div class="row">
                <div class="col"><strong>Serología:</strong> {{$historyToShow->serology}}</div>
              </div>
              <hr>
              <h4 class="text-secondary">Neonatal</h4>
              <div class="row">
                <div class="col-md-2"><strong>PAN:</strong> {{$historyToShow->pan}}g</div>
                <div class="col-md-2"><strong>TAN:</strong> {{$historyToShow->tan}}cm</div>
                <div class="col-md-2"><strong>CC:</strong> {{$historyToShow->cc_neonatal}}cm</div>
                <div class="col-md-2"><strong>APGAR:</strong> {{$historyToShow->apgar_1}}' / {{$historyToShow->apgar_5}}'</div>
                <div class="col-md-4"><strong>Método:</strong> {{$historyToShow->method_capurro_ballard}}</div>
              </div>
              <div class="row mt-2">
                <div class="col"><strong>Observaciones:</strong> {{$historyToShow->neonatal_observations}}</div>
              </div>
              <hr>
              <h4 class="text-secondary">Alimentación y Desarrollo</h4>
              <div class="row">
                <div class="col-md-4"><strong>LME:</strong> {{$historyToShow->lme_months}} meses</div>
                <div class="col-md-4"><strong>Fórmula:</strong> {{$historyToShow->formula_months}} meses</div>
                <div class="col-md-4"><strong>Ablactación:</strong> {{$historyToShow->ablactation_months}} meses</div>
              </div>
              <div class="row mt-2">
                <div class="col"><strong>Hitos del Desarrollo:</strong> {{$historyToShow->milestones}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col"><strong>Plan:</strong> {{$historyToShow->plan_ped}}</div>
              </div>
              <hr>
              <div class="flex justify-content-center mt-4">
                <button class="btn btn-dark text-white"
                    wire:click.prevent="handleTabs('isOpenHistories', 'isShowHistory')" type="button">
                    {{ __('Back') }}
                </button>
             </div>
          </div>
      </div>
  </div>
</div>
