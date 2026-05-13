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

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Antecedentes Prenatales y Obstétricos') }}</h4>
                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <x-label for="maternal_age" value="{{ __('Edad materna') }}" />
                                    <x-input id="maternal_age" type="number" class="block mt-1 w-full" wire:model="maternal_age" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="gestas_ped" value="{{ __('Gestas') }}" />
                                    <x-input id="gestas_ped" type="number" class="block mt-1 w-full" wire:model="gestas_ped" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="paras" value="{{ __('Paras') }}" />
                                    <x-input id="paras" type="number" class="block mt-1 w-full" wire:model="paras" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="abortos_ped" value="{{ __('Abortos') }}" />
                                    <x-input id="abortos_ped" type="number" class="block mt-1 w-full" wire:model="abortos_ped" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="controlled_pregnancy" value="{{ __('Embarazo controlado') }}" />
                                    <select class="form-select" wire:model="controlled_pregnancy">
                                        <option value="">{{ __('Select') }}...</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <x-label for="consultations_count" value="{{ __('Consultas') }}" />
                                    <x-input id="consultations_count" type="number" class="block mt-1 w-full" wire:model="consultations_count" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <x-label for="pregnancy_complications" value="{{ __('Complicaciones embarazo') }}" />
                                    <x-input id="pregnancy_complications" type="text" class="block mt-1 w-full" wire:model="pregnancy_complications" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <x-label for="serology" value="{{ __('Serología (VIH, VDRL, Toxop, Hep B)') }}" />
                                    <x-input id="serology" type="text" class="block mt-1 w-full" wire:model="serology" />
                                </div>
                                <div class="col-md-3">
                                    <x-label for="mother_blood_type" value="{{ __('Tipaje materno') }}" />
                                    <x-input id="mother_blood_type" type="text" class="block mt-1 w-full" wire:model="mother_blood_type" />
                                </div>
                                <div class="col-md-3">
                                    <x-label for="father_blood_type" value="{{ __('Tipaje paterno') }}" />
                                    <x-input id="father_blood_type" type="text" class="block mt-1 w-full" wire:model="father_blood_type" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <x-label for="urinalysis" value="{{ __('Uroanálisis') }}" />
                                    <x-input id="urinalysis" type="text" class="block mt-1 w-full" wire:model="urinalysis" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="delivery_method" value="{{ __('Obtenido por') }}" />
                                    <select class="form-select" wire:model="delivery_method">
                                        <option value="">{{ __('Select') }}...</option>
                                        <option value="Parto">Parto</option>
                                        <option value="Cesárea">Cesárea</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <x-label for="gestational_weeks" value="{{ __('Semanas gest.') }}" />
                                    <x-input id="gestational_weeks" type="number" class="block mt-1 w-full" wire:model="gestational_weeks" />
                                </div>
                                <div class="col-md-4">
                                    <x-label for="cesarean_indication" value="{{ __('Indicación de cesárea') }}" />
                                    <x-input id="cesarean_indication" type="text" class="block mt-1 w-full" wire:model="cesarean_indication" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <x-label for="apgar_1" value="{{ __('APGAR 1\'') }}" />
                                    <x-input id="apgar_1" type="number" class="block mt-1 w-full" wire:model="apgar_1" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="apgar_5" value="{{ __('APGAR 5\'') }}" />
                                    <x-input id="apgar_5" type="number" class="block mt-1 w-full" wire:model="apgar_5" />
                                </div>
                                <div class="col-md-4">
                                    <x-label for="amniotic_liquid" value="{{ __('Líquido amniótico') }}" />
                                    <x-input id="amniotic_liquid" type="text" class="block mt-1 w-full" wire:model="amniotic_liquid" />
                                </div>
                                <div class="col-md-4">
                                    <x-label for="other_complications" value="{{ __('Otras complicaciones') }}" />
                                    <x-input id="other_complications" type="text" class="block mt-1 w-full" wire:model="other_complications" />
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Antecedentes Neonatales y Personales') }}</h4>
                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <x-label for="pan" value="{{ __('PAN (gr)') }}" />
                                    <x-input id="pan" type="number" step="0.01" class="block mt-1 w-full" wire:model="pan" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="tan" value="{{ __('TAN (cm)') }}" />
                                    <x-input id="tan" type="number" step="0.01" class="block mt-1 w-full" wire:model="tan" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="cc_neonatal" value="{{ __('CC (cm)') }}" />
                                    <x-input id="cc_neonatal" type="number" step="0.01" class="block mt-1 w-full" wire:model="cc_neonatal" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="ct_neonatal" value="{{ __('CT (cm)') }}" />
                                    <x-input id="ct_neonatal" type="number" step="0.01" class="block mt-1 w-full" wire:model="ct_neonatal" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="ca_neonatal" value="{{ __('CA (cm)') }}" />
                                    <x-input id="ca_neonatal" type="number" step="0.01" class="block mt-1 w-full" wire:model="ca_neonatal" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <x-label for="breathed_cried" value="{{ __('Respiró/Lloró al nacer') }}" />
                                    <select class="form-select" wire:model="breathed_cried">
                                        <option value="">{{ __('Select') }}...</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <x-label for="hospitalized_at_birth" value="{{ __('Hospitalización al nacer') }}" />
                                    <select class="form-select" wire:model="hospitalized_at_birth">
                                        <option value="">{{ __('Select') }}...</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <x-label for="gestational_age_weeks" value="{{ __('Edad gest. (semanas)') }}" />
                                    <x-input id="gestational_age_weeks" type="number" class="block mt-1 w-full" wire:model="gestational_age_weeks" />
                                </div>
                                <div class="col-md-3">
                                    <x-label for="method_capurro_ballard" value="{{ __('Método') }}" />
                                    <x-input id="method_capurro_ballard" type="text" class="block mt-1 w-full" wire:model="method_capurro_ballard" placeholder="Capurro/Ballard" />
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <x-label for="neonatal_observations" value="{{ __('Observaciones Neonatales') }}" />
                                    <textarea id="neonatal_observations" class="form-control block mt-1 w-full" wire:model="neonatal_observations" rows="2"></textarea>
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Alimentación y Desarrollo') }}</h4>
                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <x-label for="lme_months" value="{{ __('LME (meses)') }}" />
                                    <x-input id="lme_months" type="number" class="block mt-1 w-full" wire:model="lme_months" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="formula_months" value="{{ __('FÓRMULA (meses)') }}" />
                                    <x-input id="formula_months" type="number" class="block mt-1 w-full" wire:model="formula_months" />
                                </div>
                                <div class="col-md-4">
                                    <x-label for="formula_indication" value="{{ __('Indicación fórmula') }}" />
                                    <x-input id="formula_indication" type="text" class="block mt-1 w-full" wire:model="formula_indication" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="ablactation_months" value="{{ __('Ablactación (meses)') }}" />
                                    <x-input id="ablactation_months" type="number" class="block mt-1 w-full" wire:model="ablactation_months" />
                                </div>
                                <div class="col-md-2">
                                    <x-label for="family_diet_incorporation" value="{{ __('Dieta familiar') }}" />
                                    <select class="form-select" wire:model="family_diet_incorporation">
                                        <option value="">{{ __('Select') }}...</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <x-label value="{{ __('Hitos del Desarrollo (Meses)') }}" />
                                    <textarea id="milestones" class="form-control block mt-1 w-full" wire:model="milestones" rows="2" placeholder="Sostén cefálico, Rolado, Sedestación, Gateo, Bipedestación, Marcha, Dentición, Habla, Esfínter"></textarea>
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Hábitos y Examen Físico') }}</h4>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <x-label for="habits_ped" value="{{ __('Hábitos (Evacuaciones, Micciones, Sueño)') }}" />
                                    <textarea id="habits_ped" class="form-control block mt-1 w-full" wire:model="habits_ped" rows="2"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <x-label for="percentiles" value="{{ __('Percentiles (P/E, T/E, P/T)') }}" />
                                    <textarea id="percentiles" class="form-control block mt-1 w-full" wire:model="percentiles" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <x-label for="physical_exam_ped" value="{{ __('Examen Físico Detallado') }}" />
                                    <textarea id="physical_exam_ped" class="form-control block mt-1 w-full" wire:model="physical_exam_ped" rows="3"></textarea>
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Vacunas e Inmunizaciones') }}</h4>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <textarea id="vaccines" class="form-control block mt-1 w-full" wire:model="vaccines" rows="3" placeholder="BCG, Hepatitis B, Polio, Pentavalente, Rotavirus, Influenza, Trivalente, etc."></textarea>
                                </div>
                            </div>

                            <h4 class="mb-4 text-primary border-bottom pb-2">{{ __('Otros') }}</h4>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <x-label for="family_history_ped" value="{{ __('Antecedentes Familiares') }}" />
                                    <textarea id="family_history_ped" class="form-control block mt-1 w-full" wire:model="family_history_ped" rows="2"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <x-label for="plan_ped" value="{{ __('Plan de manejo') }}" />
                                    <textarea id="plan_ped" class="form-control block mt-1 w-full" wire:model="plan_ped" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <x-label for="objective_ped" value="{{ __('Objetivo') }}" />
                                    <textarea id="objective_ped" class="form-control block mt-1 w-full" wire:model="objective_ped" rows="2"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <x-label for="subjective_ped" value="{{ __('Subjetivo') }}" />
                                    <textarea id="subjective_ped" class="form-control block mt-1 w-full" wire:model="subjective_ped" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="flex justify-content-center mt-4 gap-2">
                                <button class="btn btn-dark text-white"
                                    wire:click.prevent="handleTabs('isOpenCondition', 'isOpenPediatrics')"
                                    type="button">
                                    {{ __('Back') }}
                                </button>
                                <button class="btn btn-primary text-white"
                                    wire:click.prevent="updateAssessment"
                                    type="button">
                                    {{ __('Save Progress') }}
                                </button>
                                <button class="btn btn-success text-white"
                                    wire:click.prevent="handleTabs('isOpenConditionTwo', 'isOpenPediatrics', 'updateAssessment')"
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
