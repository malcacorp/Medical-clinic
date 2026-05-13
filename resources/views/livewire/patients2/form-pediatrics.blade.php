<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-validation-errors class="mb-4" />
        <input type="hidden" wire:model="patient_id">
        <input type="hidden" wire:model="assessment_id">

        {{-- ── SECCIÓN 1: Antecedentes Perinatales ── --}}
        <div class="ped-section mb-4">
            <div class="ped-section__header" data-bs-toggle="collapse" data-bs-target="#sec-perinatal">
                <span class="ped-section__icon">🤰</span>
                <span>{{ __('Antecedentes Perinatales') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-perinatal">
                <div class="ped-section__body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Edad Materna') }}</label>
                            <input type="number" class="form-control" wire:model="maternal_age" min="0" placeholder="años">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Gestas') }}</label>
                            <input type="number" class="form-control" wire:model="gestas_ped" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Paras') }}</label>
                            <input type="number" class="form-control" wire:model="paras" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Abortos') }}</label>
                            <input type="number" class="form-control" wire:model="abortos_ped" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Embarazo Controlado') }}</label>
                            <select class="form-select" wire:model="controlled_pregnancy">
                                <option value="">-- Seleccionar --</option>
                                <option value="1">{{ __('Sí') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('N° Consultas Prenatales') }}</label>
                            <input type="number" class="form-control" wire:model="consultations_count" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Grupo Sanguíneo Madre') }}</label>
                            <input type="text" class="form-control" wire:model="mother_blood_type">
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Grupo Sanguíneo Padre') }}</label>
                            <input type="text" class="form-control" wire:model="father_blood_type">
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Serología') }}</label>
                            <textarea class="form-control" rows="2" wire:model="serology"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Urinálisis') }}</label>
                            <textarea class="form-control" rows="2" wire:model="urinalysis"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="ped-label">{{ __('Complicaciones del Embarazo') }}</label>
                            <textarea class="form-control" rows="2" wire:model="pregnancy_complications"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 2: Parto / Nacimiento ── --}}
        <div class="ped-section mb-4">
            <div class="ped-section__header" data-bs-toggle="collapse" data-bs-target="#sec-parto">
                <span class="ped-section__icon">👶</span>
                <span>{{ __('Parto y Nacimiento') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-parto">
                <div class="ped-section__body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Método de Parto') }}</label>
                            <select class="form-select" wire:model="delivery_method">
                                <option value="">-- Seleccionar --</option>
                                <option value="Vaginal">{{ __('Vaginal') }}</option>
                                <option value="Cesárea">{{ __('Cesárea') }}</option>
                                <option value="Fórceps">{{ __('Fórceps') }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Semanas Gestacionales') }}</label>
                            <input type="number" class="form-control" wire:model="gestational_weeks" min="20" max="45">
                        </div>
                        <div class="col-md-4">
                            <label class="ped-label">{{ __('Indicación Cesárea') }}</label>
                            <input type="text" class="form-control" wire:model="cesarean_indication">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('APGAR 1 min') }}</label>
                            <input type="number" class="form-control" wire:model="apgar_1" min="0" max="10">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('APGAR 5 min') }}</label>
                            <input type="number" class="form-control" wire:model="apgar_5" min="0" max="10">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Líquido Amniótico') }}</label>
                            <input type="text" class="form-control" wire:model="amniotic_liquid">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('¿Respiró / Lloró?') }}</label>
                            <select class="form-select" wire:model="breathed_cried">
                                <option value="">-- Seleccionar --</option>
                                <option value="1">{{ __('Sí') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="ped-label">{{ __('Otras Complicaciones') }}</label>
                            <textarea class="form-control" rows="2" wire:model="other_complications"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 3: Datos Neonatales ── --}}
        <div class="ped-section mb-4">
            <div class="ped-section__header" data-bs-toggle="collapse" data-bs-target="#sec-neonatal">
                <span class="ped-section__icon">📏</span>
                <span>{{ __('Datos Neonatales') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-neonatal">
                <div class="ped-section__body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('PAN (kg)') }}</label>
                            <input type="number" step="0.01" class="form-control" wire:model="pan">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('TAN (cm)') }}</label>
                            <input type="number" step="0.1" class="form-control" wire:model="tan">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('CC Neonatal (cm)') }}</label>
                            <input type="number" step="0.1" class="form-control" wire:model="cc_neonatal">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('CT Neonatal (cm)') }}</label>
                            <input type="number" step="0.1" class="form-control" wire:model="ct_neonatal">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('CA Neonatal (cm)') }}</label>
                            <input type="number" step="0.1" class="form-control" wire:model="ca_neonatal">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('¿Hospitalizado al nacer?') }}</label>
                            <select class="form-select" wire:model="hospitalized_at_birth">
                                <option value="">-- Seleccionar --</option>
                                <option value="1">{{ __('Sí') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Edad Gestacional (sem)') }}</label>
                            <input type="number" class="form-control" wire:model="gestational_age_weeks">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Método Capurro / Ballard') }}</label>
                            <input type="text" class="form-control" wire:model="method_capurro_ballard">
                        </div>
                        <div class="col-12">
                            <label class="ped-label">{{ __('Observaciones Neonatales') }}</label>
                            <textarea class="form-control" rows="2" wire:model="neonatal_observations"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 4: Alimentación ── --}}
        <div class="ped-section mb-4">
            <div class="ped-section__header" data-bs-toggle="collapse" data-bs-target="#sec-alimentacion">
                <span class="ped-section__icon">🍼</span>
                <span>{{ __('Alimentación') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-alimentacion">
                <div class="ped-section__body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('LME (meses)') }}</label>
                            <input type="number" class="form-control" wire:model="lme_months" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Fórmula (meses)') }}</label>
                            <input type="number" class="form-control" wire:model="formula_months" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('Ablactación (meses)') }}</label>
                            <input type="number" class="form-control" wire:model="ablactation_months" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="ped-label">{{ __('¿Dieta Familiar?') }}</label>
                            <select class="form-select" wire:model="family_diet_incorporation">
                                <option value="">-- Seleccionar --</option>
                                <option value="1">{{ __('Sí') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="ped-label">{{ __('Indicación de Fórmula') }}</label>
                            <textarea class="form-control" rows="2" wire:model="formula_indication"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 5: Desarrollo y Hábitos ── --}}
        <div class="ped-section mb-4">
            <div class="ped-section__header" data-bs-toggle="collapse" data-bs-target="#sec-desarrollo">
                <span class="ped-section__icon">🧠</span>
                <span>{{ __('Desarrollo Psicomotor y Hábitos') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-desarrollo">
                <div class="ped-section__body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Hitos Psicomotores') }}</label>
                            <textarea class="form-control" rows="3" wire:model="milestones" placeholder="Sostén cefálico, sedestación, marcha..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Hábitos') }}</label>
                            <textarea class="form-control" rows="3" wire:model="habits_ped" placeholder="Sueño, evacuación, etc."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 6: Examen Físico y Vacunas ── --}}
        <div class="ped-section mb-4">
            <div class="ped-section__header" data-bs-toggle="collapse" data-bs-target="#sec-examen">
                <span class="ped-section__icon">🩺</span>
                <span>{{ __('Examen Físico, Percentiles y Vacunas') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-examen">
                <div class="ped-section__body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Examen Físico') }}</label>
                            <textarea class="form-control" rows="3" wire:model="physical_exam_ped"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Percentiles') }}</label>
                            <textarea class="form-control" rows="3" wire:model="percentiles" placeholder="Peso, talla, PC..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Vacunas') }}</label>
                            <textarea class="form-control" rows="3" wire:model="vaccines" placeholder="BCG, Hepatitis B, DPT..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Antecedentes Familiares') }}</label>
                            <textarea class="form-control" rows="3" wire:model="family_history_ped"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 7: SOAP ── --}}
        <div class="ped-section mb-4">
            <div class="ped-section__header" data-bs-toggle="collapse" data-bs-target="#sec-soap">
                <span class="ped-section__icon">📝</span>
                <span>{{ __('Nota SOAP') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-soap">
                <div class="ped-section__body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Subjetivo') }}</label>
                            <textarea class="form-control" rows="3" wire:model="subjective_ped" placeholder="Motivo de consulta referido por la familia..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="ped-label">{{ __('Objetivo') }}</label>
                            <textarea class="form-control" rows="3" wire:model="objective_ped" placeholder="Hallazgos clínicos..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="ped-label">{{ __('Plan') }}</label>
                            <textarea class="form-control" rows="3" wire:model="plan_ped" placeholder="Plan de manejo, citas de seguimiento..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Botones de navegación --}}
        <div class="flex justify-content-center gap-2 mt-4 mb-2">
            <button class="btn btn-dark text-white px-4"
                wire:click.prevent="handleTabs('isOpenConditionTwo', 'isOpenPediatrics')"
                type="button">
                ← {{ __('Atrás') }}
            </button>
            <button class="btn btn-success text-white px-4"
                wire:click.prevent="handleTabs('isOpenHistories', 'isOpenPediatrics')"
                type="button">
                {{ __('Guardar y Ver Historial') }} ✓
            </button>
        </div>
    </div>
</div>

<style>
.ped-section {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

.ped-section__header {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.85rem 1.25rem;
    background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    user-select: none;
    transition: background 0.2s;
}

.ped-section__header:hover {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
}

.ped-section__icon {
    font-size: 1.1rem;
}

.ped-section__header .fa-chevron-down {
    transition: transform 0.25s ease;
    color: #b91c1c;
}

.ped-section__body {
    padding: 1.25rem;
    background: #fff;
}

.ped-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.3rem;
    display: block;
}
</style>
