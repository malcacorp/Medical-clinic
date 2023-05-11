<x-slot name="header">
    <h2 class="ms-4 h3">
        {{ __('Patients') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto">
        <div class="">
            @if (session()->has('message'))
                <div class="alert alert-info" role="alert">
                    <div class="flex">
                        {{ session('message') }}</p>
                    </div>
                </div>
            @endif

            <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">Create New
                Patient</button>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id Number</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Sex</th>
                                    <th>Phone number</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id Number</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Sex</th>
                                    <th>Phone number</th>
                                    <th> </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($patients as $patient)
                                    <tr>
                                        <td whitespace-nowrap">
                                            {{ $patient->id_number }}
                                        </td>
                                        <td whitespace-nowrap">
                                            {{ $patient->first_name }}
                                        </td>
                                        <td whitespace-nowrap">
                                            {{ $patient->last_name }}
                                        </td>
                                        <td whitespace-nowrap">
                                            {{ $patient->sex }}
                                        </td>
                                        <td whitespace-nowrap">
                                            {{ $patient->phone_number }}
                                        </td>
                                        <td class="px-5">
                                            @can('edit-patient')
                                                <button wire:click="irAComponenteB({{ $patient->id }})"
                                                    class="btn btn-primary btn-sm">Edit</button>
                                            @endcan

                                            {{-- @can('delete-patient')
                                                <button wire:click="delete({{ $patient->id }})"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            @endcan --}}

                                            @can('show-patient-history')
                                                <button wire:click="showHistories({{ $patient->id }})"
                                                    class="btn btn-warning btn-sm">Show History</button>
                                            @endcan

                                            @can('create-assessment')
                                                <button wire:click="assessment({{ $patient->id }})"
                                                    class="btn btn-success btn-sm">Assessment</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="2" class="px-5 font-medium text-gray-900 whitespace-nowrap">
                                            {{ __('No patients found') }}
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
