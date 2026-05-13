<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-validation-errors class="mb-4" />
        <input type="hidden" wire:model="patient_id">
        <input type="hidden" wire:model="assessment_id">

        {{-- ── SECCIÓN 1: Datos Menstruales ── --}}
        <div class="gyn-section mb-4">
            <div class="gyn-section__header" data-bs-toggle="collapse" data-bs-target="#sec-menstrual">
                <span class="gyn-section__icon">📅</span>
                <span>{{ __('Antecedentes Menstruales') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-menstrual">
                <div class="gyn-section__body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="gyn-label">{{ __('FUR (Fecha Última Regla)') }}</label>
                            <input type="date" class="form-control" wire:model="fur">
                        </div>
                        <div class="col-md-3">
                            <label class="gyn-label">{{ __('Menarquia (edad)') }}</label>
                            <input type="text" class="form-control" wire:model="menarquia" placeholder="ej. 12 años">
                        </div>
                        <div class="col-md-3">
                            <label class="gyn-label">{{ __('Ciclos (Frec/Dur/Cant)') }}</label>
                            <input type="text" class="form-control" wire:model="cycles" placeholder="ej. 28/5/abundante">
                        </div>
                        <div class="col-md-3">
                            <label class="gyn-label">{{ __('Vida Sexual Activa') }}</label>
                            <select class="form-select" wire:model="sexual_activity">
                                <option value="">-- {{ __('Seleccionar') }} --</option>
                                <option value="1">{{ __('Sí') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="gyn-label">{{ __('Coitarche (edad)') }}</label>
                            <input type="text" class="form-control" wire:model="coitarche">
                        </div>
                        <div class="col-md-3">
                            <label class="gyn-label">{{ __('Nro. Parejas') }}</label>
                            <input type="number" class="form-control" wire:model="partners" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="gyn-label">{{ __('Anticonceptivo Actual') }}</label>
                            <input type="text" class="form-control" wire:model="contraceptive">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 2: Exámenes Preventivos ── --}}
        <div class="gyn-section mb-4">
            <div class="gyn-section__header" data-bs-toggle="collapse" data-bs-target="#sec-preventivos">
                <span class="gyn-section__icon">🔬</span>
                <span>{{ __('Exámenes Preventivos') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-preventivos">
                <div class="gyn-section__body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="gyn-label">{{ __('Último Papanicolaou') }}</label>
                            <input type="date" class="form-control" wire:model="papanicolaou">
                        </div>
                        <div class="col-md-4">
                            <label class="gyn-label">{{ __('Última Mamografía') }}</label>
                            <input type="date" class="form-control" wire:model="mammography">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 3: Antecedentes Obstétricos (G P C A E) ── --}}
        <div class="gyn-section mb-4">
            <div class="gyn-section__header" data-bs-toggle="collapse" data-bs-target="#sec-obstetrico">
                <span class="gyn-section__icon">🤱</span>
                <span>{{ __('Antecedentes Obstétricos') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-obstetrico">
                <div class="gyn-section__body">
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered text-center align-middle mb-0">
                            <thead style="background: #f3f4f6;">
                                <tr>
                                    <th>{{ __('Gestas') }}</th>
                                    <th>{{ __('Partos') }}</th>
                                    <th>{{ __('Cesáreas') }}</th>
                                    <th>{{ __('Abortos') }}</th>
                                    <th>{{ __('Ectópicos') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="number" class="form-control text-center" wire:model="gestas" min="0"></td>
                                    <td><input type="number" class="form-control text-center" wire:model="partos" min="0"></td>
                                    <td><input type="number" class="form-control text-center" wire:model="cesareas" min="0"></td>
                                    <td><input type="number" class="form-control text-center" wire:model="abortos" min="0"></td>
                                    <td><input type="number" class="form-control text-center" wire:model="ectopicos" min="0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="gyn-label">{{ __('Fecha Último Parto / Cesárea') }}</label>
                            <input type="date" class="form-control" wire:model="last_delivery">
                        </div>
                        <div class="col-md-8">
                            <label class="gyn-label">{{ __('Complicaciones Obstétricas Previas') }}</label>
                            <input type="text" class="form-control" wire:model="obstetric_complications">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 4: Antecedentes Personales y Familiares ── --}}
        <div class="gyn-section mb-4">
            <div class="gyn-section__header" data-bs-toggle="collapse" data-bs-target="#sec-antecedentes">
                <span class="gyn-section__icon">👨‍👩‍👧</span>
                <span>{{ __('Antecedentes Personales y Familiares') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-antecedentes">
                <div class="gyn-section__body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="gyn-label">{{ __('Antecedentes Familiares (Cáncer, HTA, DM)') }}</label>
                            <textarea class="form-control" rows="3" wire:model="family_history"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="gyn-label">{{ __('Hábitos (Tabaco, Alcohol, Drogas)') }}</label>
                            <textarea class="form-control" rows="3" wire:model="habits"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 5: Motivo y Examen Físico ── --}}
        <div class="gyn-section mb-4">
            <div class="gyn-section__header" data-bs-toggle="collapse" data-bs-target="#sec-examen-gyn">
                <span class="gyn-section__icon">🩺</span>
                <span>{{ __('Motivo de Consulta y Examen Físico') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-examen-gyn">
                <div class="gyn-section__body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="gyn-label">{{ __('Enfermedad Actual') }}</label>
                            <textarea class="form-control" rows="3" wire:model="current_illness"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="gyn-label">{{ __('Examen Físico Ginecológico (Vulva, Espéculo, Tacto)') }}</label>
                            <textarea class="form-control" rows="3" wire:model="physical_exam_gyneco"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SECCIÓN 6: Plan y Tratamiento ── --}}
        <div class="gyn-section mb-4">
            <div class="gyn-section__header" data-bs-toggle="collapse" data-bs-target="#sec-plan-gyn">
                <span class="gyn-section__icon">📋</span>
                <span>{{ __('Plan y Tratamiento') }}</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </div>
            <div class="collapse show" id="sec-plan-gyn">
                <div class="gyn-section__body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="gyn-label">{{ __('Plan de Manejo') }}</label>
                            <textarea class="form-control" rows="3" wire:model="management_plan"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="gyn-label">{{ __('Exámenes Solicitados') }}</label>
                            <textarea class="form-control" rows="3" wire:model="requested_exams"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Botones de navegación --}}
        <div class="flex justify-content-center gap-2 mt-4 mb-2">
            <button class="btn btn-dark text-white px-4"
                wire:click.prevent="handleTabs('isOpenConditionTwo', 'isOpenGynecology')"
                type="button">
                ← {{ __('Atrás') }}
            </button>
            <button class="btn btn-success text-white px-4"
                wire:click.prevent="handleTabs('isOpenHistories', 'isOpenGynecology')"
                type="button">
                {{ __('Guardar y Ver Historial') }} ✓
            </button>
        </div>
    </div>
</div>

<style>
.gyn-section {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}
.gyn-section__header {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.85rem 1.25rem;
    background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 100%);
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    user-select: none;
    transition: background 0.2s;
}
.gyn-section__header:hover {
    background: linear-gradient(135deg, #991b1b 0%, #dc2626 100%);
}
.gyn-section__icon { font-size: 1.1rem; }
.gyn-section__header .fa-chevron-down {
    transition: transform 0.25s ease;
    color: #fca5a5;
}
.gyn-section__body {
    padding: 1.25rem;
    background: #fff;
}
.gyn-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.3rem;
    display: block;
}
</style>
