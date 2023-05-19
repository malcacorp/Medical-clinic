<x-app-layout>
    <x-slot name="header">
        <h2 class="ms-4 h3">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-welcome-admin />
    {{-- @if (auth()->check() && auth()->user()->roles->contains('name','patient'))
        <x-welcome-patient />
    @if (auth()->check() && auth()->user()->roles->contains('name', 'admin'))
    @else
        <x-welcome />
    @endcan --}}
</x-app-layout>
