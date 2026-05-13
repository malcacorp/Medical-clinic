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
              {{-- Sección Pediatría (condicional) --}}
              @if ($historyToShow->assessment_type === 'Pediatrics')
              <div class="ped-detail-section mt-3">
                  <div class="ped-detail-header mb-3">
                      <span>🩺 {{ __('Historia Clínica Pediátrica') }}</span>
                  </div>
                  <div class="row g-2">
                    <div class="col-md-6">
                        <strong>{{ __('Edad Materna') }}:</strong> {{ $historyToShow->maternal_age }} {{ __('años') }}
                    </div>
                    <div class="col-md-6">
                        <strong>G:</strong> {{ $historyToShow->gestas_ped }}
                        <strong> P:</strong> {{ $historyToShow->paras }}
                        <strong> A:</strong> {{ $historyToShow->abortos_ped }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ __('Embarazo Controlado') }}:</strong> {{ $historyToShow->controlled_pregnancy ? __('Sí') : __('No') }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ __('N° Consultas') }}:</strong> {{ $historyToShow->consultations_count }}
                    </div>
                    <div class="col-md-4">
                        <strong>{{ __('Parto') }}:</strong> {{ $historyToShow->delivery_method }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('APGAR 1\'') }}:</strong> {{ $historyToShow->apgar_1 }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('APGAR 5\'') }}:</strong> {{ $historyToShow->apgar_5 }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Sem. Gestacionales') }}:</strong> {{ $historyToShow->gestational_weeks }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Respiró/Lloró') }}:</strong> {{ $historyToShow->breathed_cried ? __('Sí') : __('No') }}
                    </div>
                    <div class="col-md-3">
                        <strong>PAN:</strong> {{ $historyToShow->pan }} kg
                    </div>
                    <div class="col-md-3">
                        <strong>TAN:</strong> {{ $historyToShow->tan }} cm
                    </div>
                    <div class="col-md-3">
                        <strong>CC:</strong> {{ $historyToShow->cc_neonatal }} cm
                    </div>
                    <div class="col-md-3">
                        <strong>CT:</strong> {{ $historyToShow->ct_neonatal }} cm
                    </div>
                    @if($historyToShow->neonatal_observations)
                    <div class="col-12">
                        <strong>{{ __('Observaciones Neonatales') }}:</strong> {{ $historyToShow->neonatal_observations }}
                    </div>
                    @endif
                    <div class="col-md-3">
                        <strong>{{ __('LME') }}:</strong> {{ $historyToShow->lme_months }} meses
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Fórmula') }}:</strong> {{ $historyToShow->formula_months }} meses
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Ablactación') }}:</strong> {{ $historyToShow->ablactation_months }} meses
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Dieta Familiar') }}:</strong> {{ $historyToShow->family_diet_incorporation ? __('Sí') : __('No') }}
                    </div>
                    @if($historyToShow->milestones)
                    <div class="col-12">
                        <strong>{{ __('Hitos Psicomotores') }}:</strong> {{ $historyToShow->milestones }}
                    </div>
                    @endif
                    @if($historyToShow->vaccines)
                    <div class="col-12">
                        <strong>{{ __('Vacunas') }}:</strong> {{ $historyToShow->vaccines }}
                    </div>
                    @endif
                    @if($historyToShow->percentiles)
                    <div class="col-12">
                        <strong>{{ __('Percentiles') }}:</strong> {{ $historyToShow->percentiles }}
                    </div>
                    @endif
                    @if($historyToShow->physical_exam_ped)
                    <div class="col-12">
                        <strong>{{ __('Examen Físico') }}:</strong> {{ $historyToShow->physical_exam_ped }}
                    </div>
                    @endif
                    @if($historyToShow->plan_ped)
                    <div class="col-12">
                        <strong>{{ __('Plan') }}:</strong> {{ $historyToShow->plan_ped }}
                    </div>
                    @endif
                  </div>
              </div>
              @endif

              {{-- Sección Ginecología (condicional) --}}
              @if ($historyToShow->assessment_type === 'Gynecology')
              <div class="ped-detail-section mt-3">
                  <div class="ped-detail-header mb-3" style="border-bottom: 2px solid #7f1d1d;">
                      <span>🩺 {{ __('Historia Clínica Ginecológica') }}</span>
                  </div>
                  <div class="row g-2">
                    <div class="col-md-3">
                        <strong>{{ __('FUR') }}:</strong> {{ $historyToShow->fur }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Menarquia') }}:</strong> {{ $historyToShow->menarquia }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Ciclos') }}:</strong> {{ $historyToShow->cycles }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Vida Sexual Activa') }}:</strong> {{ $historyToShow->sexual_activity ? __('Sí') : __('No') }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Coitarche') }}:</strong> {{ $historyToShow->coitarche }}
                    </div>
                    <div class="col-md-3">
                        <strong>{{ __('Nro Parejas') }}:</strong> {{ $historyToShow->partners }}
                    </div>
                    <div class="col-md-6">
                        <strong>{{ __('Anticonceptivo Actual') }}:</strong> {{ $historyToShow->contraceptive }}
                    </div>
                    <div class="col-md-6">
                        <strong>{{ __('Último Papanicolaou') }}:</strong> {{ $historyToShow->papanicolaou }}
                    </div>
                    <div class="col-md-6">
                        <strong>{{ __('Última Mamografía') }}:</strong> {{ $historyToShow->mammography }}
                    </div>
                    <div class="col-md-12 mt-2">
                        <strong>G:</strong> {{ $historyToShow->gestas }}
                        <strong> P:</strong> {{ $historyToShow->partos }}
                        <strong> C:</strong> {{ $historyToShow->cesareas }}
                        <strong> A:</strong> {{ $historyToShow->abortos }}
                        <strong> E:</strong> {{ $historyToShow->ectopicos }}
                    </div>
                    <div class="col-md-6">
                        <strong>{{ __('Fecha Último Parto') }}:</strong> {{ $historyToShow->last_delivery }}
                    </div>
                    @if($historyToShow->obstetric_complications)
                    <div class="col-12">
                        <strong>{{ __('Complicaciones Obstétricas') }}:</strong> {{ $historyToShow->obstetric_complications }}
                    </div>
                    @endif
                    @if($historyToShow->family_history)
                    <div class="col-12">
                        <strong>{{ __('Antecedentes Familiares') }}:</strong> {{ $historyToShow->family_history }}
                    </div>
                    @endif
                    @if($historyToShow->habits)
                    <div class="col-12">
                        <strong>{{ __('Hábitos') }}:</strong> {{ $historyToShow->habits }}
                    </div>
                    @endif
                    @if($historyToShow->current_illness)
                    <div class="col-12">
                        <strong>{{ __('Enfermedad Actual') }}:</strong> {{ $historyToShow->current_illness }}
                    </div>
                    @endif
                    @if($historyToShow->physical_exam_gyneco)
                    <div class="col-12">
                        <strong>{{ __('Examen Físico') }}:</strong> {{ $historyToShow->physical_exam_gyneco }}
                    </div>
                    @endif
                    @if($historyToShow->requested_exams)
                    <div class="col-12">
                        <strong>{{ __('Exámenes Solicitados') }}:</strong> {{ $historyToShow->requested_exams }}
                    </div>
                    @endif
                    @if($historyToShow->management_plan)
                    <div class="col-12">
                        <strong>{{ __('Plan de Manejo') }}:</strong> {{ $historyToShow->management_plan }}
                    </div>
                    @endif
                  </div>
              </div>
              @endif

              <style>
              .ped-detail-section { background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 10px; padding: 1rem 1.25rem; }
              .ped-detail-header { font-weight: 700; font-size: 1rem; color: #111827; border-bottom: 2px solid #b91c1c; padding-bottom: 0.5rem; }
              </style>
              
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
