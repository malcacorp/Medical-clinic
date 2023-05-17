<x-app-layout>
    <x-slot name="header">
        <h2 class="ms-4 h3">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (auth()->check() && auth()->user()->roles->contains('patient'))
        <x-welcome-patient />
    @else
        <x-welcome />
    @endcan
</x-app-layout>
