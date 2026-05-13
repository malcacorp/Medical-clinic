<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                <x-validation-errors class="mb-4" />
                <div class="row">
                    <div class="col">
                        <form style="display: block">
                            @csrf
                            <input type="hidden" wire:model="patient_id">
                            <input type="hidden" wire:model="user_id">
                            <input type="hidden" wire:model="assessment_id">

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Antecedentes Gineco-Obstétricos') }}</h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <x-label for="fur" value="{{ __('Fecha de Última Regla (FUR)') }}" />
                                    <x-input id="fur" type="date" class="block mt-1 w-full" wire:model="fur" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="menarquia" value="{{ __('Menarquia (Edad)') }}" />
                                    <x-input id="menarquia" type="text" class="block mt-1 w-full" wire:model="menarquia" />
                                </div>
                                <div class="col-md-4">
                                    <x-label for="cycles" value="{{ __('Ciclos (Frec/Dur/Cant)') }}" />
                                    <x-input id="cycles" type="text" class="block mt-1 w-full" wire:model="cycles" placeholder="ej. 28/5/abundante" />
                                </div>
                                <div class="col-md-3">
                                    <x-label for="sexual_activity" value="{{ __('Vida sexual activa') }}" />
                                    <select class="form-select" wire:model="sexual_activity">
                                        <option value="">{{ __('Select') }}...</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <x-label for="coitarche" value="{{ __('Coitarche (Edad)') }}" />
                                    <x-input id="coitarche" type="text" class="block mt-1 w-full" wire:model="coitarche" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="partners" value="{{ __('Nro Parejas') }}" />
                                    <x-input id="partners" type="number" class="block mt-1 w-full" wire:model="partners" />
                                </div>
                                <div class="col-md-4">
                                    <x-label for="contraceptive" value="{{ __('Anticonceptivo Actual') }}" />
                                    <x-input id="contraceptive" type="text" class="block mt-1 w-full" wire:model="contraceptive" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="papanicolaou" value="{{ __('Último Papanicolaou') }}" />
                                    <x-input id="papanicolaou" type="date" class="block mt-1 w-full" wire:model="papanicolaou" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="mammography" value="{{ __('Última Mamografía') }}" />
                                    <x-input id="mammography" type="date" class="block mt-1 w-full" wire:model="mammography" />
                                </div>
                            </div>

                            <div class="table-responsive mb-4">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Gestas</th>
                                            <th>Partos</th>
                                            <th>Cesáreas</th>
                                            <th>Abortos</th>
                                            <th>Ectópicos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><x-input type="number" class="w-full text-center" wire:model="gestas" /></td>
                                            <td><x-input type="number" class="w-full text-center" wire:model="partos" /></td>
                                            <td><x-input type="number" class="w-full text-center" wire:model="cesareas" /></td>
                                            <td><x-input type="number" class="w-full text-center" wire:model="abortos" /></td>
                                            <td><x-input type="number" class="w-full text-center" wire:model="ectopicos" /></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <x-label for="last_delivery" value="{{ __('Fecha último Parto/Cesárea') }}" />
                                    <x-input id="last_delivery" type="date" class="block mt-1 w-full" wire:model="last_delivery" />
                                </div>
                                <div class="col-md-8">
                                    <x-label for="obstetric_complications" value="{{ __('Complicaciones Obstétricas Previas') }}" />
                                    <x-input id="obstetric_complications" type="text" class="block mt-1 w-full" wire:model="obstetric_complications" />
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Antecedentes Personales y Familiares') }}</h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <x-label for="family_history" value="{{ __('Antecedentes Familiares (Cáncer, HTA, DM)') }}" />
                                    <textarea id="family_history" class="form-control block mt-1 w-full" wire:model="family_history" rows="2"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <x-label for="habits" value="{{ __('Hábitos (Tabaco, Alcohol, Drogas)') }}" />
                                    <textarea id="habits" class="form-control block mt-1 w-full" wire:model="habits" rows="2"></textarea>
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Motivo de Consulta y Examen Físico') }}</h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <x-label for="current_illness" value="{{ __('Enfermedad Actual') }}" />
                                    <textarea id="current_illness" class="form-control block mt-1 w-full" wire:model="current_illness" rows="3"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <x-label for="physical_exam_gyneco" value="{{ __('Examen Físico Ginecológico (Vulva, Especulo, Tacto)') }}" />
                                    <textarea id="physical_exam_gyneco" class="form-control block mt-1 w-full" wire:model="physical_exam_gyneco" rows="3"></textarea>
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Plan y Tratamiento') }}</h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <x-label for="management_plan" value="{{ __('Plan de Manejo') }}" />
                                    <textarea id="management_plan" class="form-control block mt-1 w-full" wire:model="management_plan" rows="3"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <x-label for="requested_exams" value="{{ __('Exámenes Solicitados') }}" />
                                    <textarea id="requested_exams" class="form-control block mt-1 w-full" wire:model="requested_exams" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="flex justify-content-center mt-4 gap-2">
                                <button class="btn btn-dark text-white"
                                    wire:click.prevent="handleTabs('isOpenCondition', 'isOpenGynecology')"
                                    type="button">
                                    {{ __('Back') }}
                                </button>
                                <button class="btn btn-primary text-white"
                                    wire:click.prevent="updateAssessment"
                                    type="button">
                                    {{ __('Save Progress') }}
                                </button>
                                <button class="btn btn-success text-white"
                                    wire:click.prevent="handleTabs('isOpenConditionTwo', 'isOpenGynecology', 'updateAssessment')"
                                    type="button">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
