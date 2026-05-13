<x-slot name="header">
    <div class="d-flex align-items-center gap-3 ms-2 py-2">
        <div style="width:5px; height:36px; background: linear-gradient(180deg, #b91c1c, #7f1d1d); border-radius:3px; flex-shrink:0;"></div>
        <div>
            <h2 class="mb-0 fw-bold" style="font-size: 1.35rem; color: #111827; line-height: 1.2;">{{ __('Panel') }}</h2>
            <span style="font-size: 0.8rem; color: #9ca3af;">{{ __('Resumen general del sistema') }}</span>
        </div>
    </div>
</x-slot>

@if (auth()->check() && auth()->user()->roles->contains('name', 'patient'))
    <x-welcome-patient />
@else
    <x-welcome-admin />
@endif
