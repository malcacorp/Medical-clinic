<div>
    {{-- ========== STAT CARDS ========== --}}
    <div class="row g-4 mb-4 px-2">

        {{-- Card: Total Patients --}}
        <div class="col-sm-6 col-xl-4">
            <div class="stat-card stat-card--red">
                <div class="stat-card__icon">
                    <i class="fas fa-user-injured"></i>
                </div>
                <div class="stat-card__body">
                    <span class="stat-card__label">{{ __("Pacientes Totales") }}</span>
                    <span class="stat-card__value">{{ number_format($this->totalPatients) }}</span>
                </div>
                <div class="stat-card__bg-icon">
                    <i class="fas fa-user-injured"></i>
                </div>
            </div>
        </div>

        {{-- Card: Appointments Today --}}
        <div class="col-sm-6 col-xl-4">
            <div class="stat-card stat-card--dark">
                <div class="stat-card__icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-card__body">
                    <span class="stat-card__label">{{ __("Citas para Hoy") }}</span>
                    <span class="stat-card__value">{{ number_format($this->totalAppointments) }}</span>
                </div>
                <div class="stat-card__bg-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- ========== APPOINTMENTS TABLE ========== --}}
    <div class="row px-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <span class="dashboard-section-dot"></span>
                        <h5 class="mb-0 fw-bold" style="font-size: 1rem; color: #111827;">
                            {{ __("Citas de Hoy") }}
                        </h5>
                    </div>
                    <span class="dashboard-badge">
                        {{ count($this->appointments) }} {{ __("citas") }}
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>{{ __("Fecha y Hora") }}</th>
                                    <th>{{ __("Nombre") }}</th>
                                    <th>{{ __("Doctor") }}</th>
                                    <th>{{ __("Número de Teléfono") }}</th>
                                    <th>{{ __("Estado de la Cita") }}</th>
                                    <th>{{ __("Tipo de Cita") }}</th>
                                    <th>{{ __("Preocupaciones Médicas") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->appointments as $appointment)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold" style="color: #111827;">
                                                {{ $appointment->date }}
                                            </span>
                                            <br>
                                            <small class="text-muted">{{ $appointment->time }}</small>
                                        </td>

                                        @if($appointment && $appointment->patient && $appointment->employee)
                                            <td>{{ $appointment->patient->first_name . ' ' . $appointment->patient->last_name }}</td>
                                            <td>
                                                <span class="fw-medium" style="color: #374151;">
                                                    {{ $appointment->employee->first_name . ' ' . $appointment->employee->last_name }}
                                                </span>
                                            </td>
                                            <td>{{ $appointment->patient->phone_number }}</td>
                                        @elseif($appointment && $appointment->patient)
                                            <td>{{ $appointment->patient->first_name . ' ' . $appointment->patient->last_name }}</td>
                                            <td><span class="text-muted fst-italic">{{ __("Sin doctor asignado") }}</span></td>
                                            <td>{{ $appointment->patient->phone_number }}</td>
                                        @elseif($appointment)
                                            <td><span class="text-muted fst-italic">{{ __("Sin paciente") }}</span></td>
                                            <td><span class="text-muted fst-italic">{{ __("Sin doctor") }}</span></td>
                                            <td>—</td>
                                        @else
                                            <td></td><td></td><td></td>
                                        @endif

                                        <td>
                                            @if($appointment->status === 'Pending')
                                                <span class="status-badge status-badge--pending">{{ __("Pendiente") }}</span>
                                            @elseif($appointment->status === 'Attended')
                                                <span class="status-badge status-badge--attended">{{ __("Atendida") }}</span>
                                            @elseif($appointment->status === 'Canceled')
                                                <span class="status-badge status-badge--canceled">{{ __("Cancelada") }}</span>
                                            @else
                                                <span class="status-badge">{{ $appointment->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $appointment->assessment_type }}</td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 180px;" title="{{ $appointment->medical_concerns }}">
                                                {{ $appointment->medical_concerns }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fas fa-calendar-times" style="font-size: 2rem; color: #d1d5db;"></i>
                                            <p class="mt-2 mb-0 text-muted">{{ __("No hay citas para hoy") }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ========== STAT CARDS ========== */
.stat-card {
    position: relative;
    border-radius: 16px !important;
    padding: 1.75rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 32px rgba(0,0,0,0.18) !important;
}

/* Red variant */
.stat-card--red {
    background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
    color: white;
}
/* Dark variant */
.stat-card--dark {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    color: white;
}

.stat-card__icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: rgba(255,255,255,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: rgba(255,255,255,0.9);
    flex-shrink: 0;
    backdrop-filter: blur(4px);
    z-index: 2;
}

.stat-card__body {
    display: flex;
    flex-direction: column;
    z-index: 2;
}

.stat-card__label {
    font-size: 0.78rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: rgba(255,255,255,0.75);
    margin-bottom: 0.3rem;
}

.stat-card__value {
    font-size: 2.25rem;
    font-weight: 800;
    color: #ffffff;
    line-height: 1;
}

.stat-card__bg-icon {
    position: absolute;
    right: -10px;
    bottom: -10px;
    font-size: 6rem;
    color: rgba(255,255,255,0.07);
    z-index: 1;
}

/* ========== SECTION HEADER ELEMENTS ========== */
.dashboard-section-dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #b91c1c;
    flex-shrink: 0;
}

.dashboard-badge {
    background: #f3f4f6;
    color: #374151;
    font-size: 0.78rem;
    font-weight: 600;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    border: 1px solid #e5e7eb;
}

/* ========== STATUS BADGES ========== */
.status-badge {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.65rem;
    border-radius: 20px;
}
.status-badge--pending {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
}
.status-badge--attended {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #6ee7b7;
}
.status-badge--canceled {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}
</style>
