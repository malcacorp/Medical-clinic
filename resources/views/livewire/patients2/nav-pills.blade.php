<div class="patient-stepper mb-4">

    {{-- Step 1: Información del Paciente --}}
    <button type="button"
        class="stepper-step {{ ($isOpenCreate || $isOpenCreateTwo) ? 'stepper-step--active' : 'stepper-step--done' }}"
        wire:click.prevent="handleTabs('isOpenCreate', '{{ $isOpenCreateTwo ? 'isOpenCreateTwo' : ($isOpenCondition ? 'isOpenCondition' : ($isOpenConditionTwo ? 'isOpenConditionTwo' : 'isOpenHistories')) }}')">
        <div class="stepper-step__circle">
            @if ($isOpenCreate || $isOpenCreateTwo)
                <span>1</span>
            @else
                <i class="fas fa-check"></i>
            @endif
        </div>
        <div class="stepper-step__label">
            <span class="stepper-step__title">{{ __('Información') }}</span>
            <span class="stepper-step__subtitle">{{ __('del Paciente') }}</span>
        </div>
    </button>

    <div class="stepper-connector {{ ($isOpenCondition || $isOpenConditionTwo || $isOpenHistories || $isShowHistory) ? 'stepper-connector--done' : '' }}"></div>

    {{-- Step 2: Comentarios de Enfermería --}}
    <button type="button"
        class="stepper-step {{ $isOpenCondition ? 'stepper-step--active' : (($isOpenConditionTwo || $isOpenHistories || $isShowHistory) ? 'stepper-step--done' : 'stepper-step--pending') }}"
        wire:click.prevent="handleTabs('isOpenCondition', '{{ $isOpenCreate ? 'isOpenCreate' : ($isOpenCreateTwo ? 'isOpenCreateTwo' : ($isOpenConditionTwo ? 'isOpenConditionTwo' : 'isOpenHistories')) }}')">
        <div class="stepper-step__circle">
            @if ($isOpenConditionTwo || $isOpenHistories || $isShowHistory)
                <i class="fas fa-check"></i>
            @else
                <span>2</span>
            @endif
        </div>
        <div class="stepper-step__label">
            <span class="stepper-step__title">{{ __('Comentarios') }}</span>
            <span class="stepper-step__subtitle">{{ __('de Enfermería') }}</span>
        </div>
    </button>

    @can("edit-doctor-comments")
    <div class="stepper-connector {{ ($isOpenConditionTwo || $isOpenHistories || $isShowHistory) ? 'stepper-connector--done' : '' }}"></div>

    {{-- Step 3: Comentarios del Doctor --}}
    <button type="button"
        class="stepper-step {{ $isOpenConditionTwo ? 'stepper-step--active' : (($isOpenHistories || $isShowHistory) ? 'stepper-step--done' : 'stepper-step--pending') }}"
        wire:click.prevent="handleTabs('isOpenConditionTwo', '{{ $isOpenCondition ? 'isOpenCondition' : 'isOpenHistories' }}')">
        <div class="stepper-step__circle">
            @if ($isOpenHistories || $isShowHistory)
                <i class="fas fa-check"></i>
            @else
                <span>3</span>
            @endif
        </div>
        <div class="stepper-step__label">
            <span class="stepper-step__title">{{ __('Comentarios') }}</span>
            <span class="stepper-step__subtitle">{{ __('del Doctor') }}</span>
        </div>
    </button>
    @endcan

    <div class="stepper-connector {{ ($isOpenPediatrics || $isOpenGynecology || $isOpenHistories || $isShowHistory) ? 'stepper-connector--done' : '' }}"></div>

    {{-- Step 4 (condicional): Pediatría --}}
    @if ($assessment_type === 'Pediatrics')
    <button type="button"
        class="stepper-step {{ $isOpenPediatrics ? 'stepper-step--active' : (($isOpenHistories || $isShowHistory) ? 'stepper-step--done' : 'stepper-step--pending') }}"
        wire:click.prevent="handleTabs('isOpenPediatrics', '{{ $isOpenConditionTwo ? 'isOpenConditionTwo' : 'isOpenHistories' }}')">
        <div class="stepper-step__circle">
            @if ($isOpenHistories || $isShowHistory)
                <i class="fas fa-check"></i>
            @else
                @can("edit-doctor-comments") <span>4</span> @else <span>3</span> @endcan
            @endif
        </div>
        <div class="stepper-step__label">
            <span class="stepper-step__title">{{ __('Pediatría') }}</span>
            <span class="stepper-step__subtitle">{{ __('Historia Clínica') }}</span>
        </div>
    </button>
    <div class="stepper-connector {{ ($isOpenHistories || $isShowHistory) ? 'stepper-connector--done' : '' }}"></div>
    @endif

    {{-- Step 4 (condicional): Ginecología --}}
    @if ($assessment_type === 'Gynecology')
    <button type="button"
        class="stepper-step {{ $isOpenGynecology ? 'stepper-step--active' : (($isOpenHistories || $isShowHistory) ? 'stepper-step--done' : 'stepper-step--pending') }}"
        wire:click.prevent="handleTabs('isOpenGynecology', '{{ $isOpenConditionTwo ? 'isOpenConditionTwo' : 'isOpenHistories' }}')">
        <div class="stepper-step__circle">
            @if ($isOpenHistories || $isShowHistory)
                <i class="fas fa-check"></i>
            @else
                @can("edit-doctor-comments") <span>4</span> @else <span>3</span> @endcan
            @endif
        </div>
        <div class="stepper-step__label">
            <span class="stepper-step__title">{{ __('Ginecología') }}</span>
            <span class="stepper-step__subtitle">{{ __('Historia Clínica') }}</span>
        </div>
    </button>
    <div class="stepper-connector {{ ($isOpenHistories || $isShowHistory) ? 'stepper-connector--done' : '' }}"></div>
    @endif

    {{-- Step final: Historial --}}
    <button type="button"
        class="stepper-step {{ ($isOpenHistories || $isShowHistory) ? 'stepper-step--active' : 'stepper-step--pending' }}"
        wire:click.prevent="handleTabs('isOpenHistories', '{{ $isOpenCreate ? 'isOpenCreate' : ($isOpenCreateTwo ? 'isOpenCreateTwo' : ($isOpenCondition ? 'isOpenCondition' : ($isOpenConditionTwo ? 'isOpenConditionTwo' : ($isOpenPediatrics ? 'isOpenPediatrics' : ($isOpenGynecology ? 'isOpenGynecology' : ''))))) }}')">
        <div class="stepper-step__circle">
            @if (in_array($assessment_type, ['Pediatrics', 'Gynecology']))
                @can("edit-doctor-comments") <span>5</span> @else <span>4</span> @endcan
            @else
                @can("edit-doctor-comments") <span>4</span> @else <span>3</span> @endcan
            @endif
        </div>
        <div class="stepper-step__label">
            <span class="stepper-step__title">{{ __('Historial') }}</span>
            <span class="stepper-step__subtitle">{{ __('del Paciente') }}</span>
        </div>
    </button>

</div>

<style>
.patient-stepper {
    display: flex;
    align-items: center;
    background: #fff;
    border-radius: 14px;
    padding: 1.25rem 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    gap: 0;
    flex-wrap: wrap;
}

.stepper-step {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.5rem 0.75rem;
    border-radius: 10px;
    transition: all 0.2s ease;
    text-align: left;
    flex-shrink: 0;
}

.stepper-step:hover {
    background: #f9fafb;
}

.stepper-step__circle {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    font-weight: 700;
    flex-shrink: 0;
    transition: all 0.3s ease;
    border: 2.5px solid #e5e7eb;
    background: #f9fafb;
    color: #9ca3af;
}

.stepper-step--active .stepper-step__circle {
    background: #b91c1c;
    border-color: #b91c1c;
    color: #fff;
    box-shadow: 0 0 0 4px rgba(185, 28, 28, 0.12);
}

.stepper-step--done .stepper-step__circle {
    background: #111827;
    border-color: #111827;
    color: #fff;
}

.stepper-step--pending .stepper-step__circle {
    background: #f3f4f6;
    border-color: #e5e7eb;
    color: #d1d5db;
}

.stepper-step__label {
    display: flex;
    flex-direction: column;
}

.stepper-step__title {
    font-size: 0.82rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.2;
}

.stepper-step--pending .stepper-step__title {
    color: #9ca3af;
}

.stepper-step__subtitle {
    font-size: 0.72rem;
    color: #6b7280;
    font-weight: 500;
}

.stepper-step--pending .stepper-step__subtitle {
    color: #d1d5db;
}

.stepper-connector {
    flex: 1;
    height: 2px;
    background: #e5e7eb;
    min-width: 20px;
    transition: background 0.3s ease;
}

.stepper-connector--done {
    background: linear-gradient(90deg, #111827, #b91c1c);
}
</style>