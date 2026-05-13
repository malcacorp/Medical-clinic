<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="{{ __('Search') }}..." wire:model="search">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id Number</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Sex</th>
                        <th>{{ __('Phone number') }}</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                        <tr>
                            <td class="text-nowrap">
                                {{ $patient->id_number }}
                            </td>
                            <td class="text-nowrap">
                                {{ $patient->first_name }}
                            </td>
                            <td class="text-nowrap">
                                {{ $patient->last_name }}
                            </td>
                            <td class="text-nowrap">
                                {{ __($patient->sex) }}
                            </td>
                            <td class="text-nowrap">
                                {{ $patient->phone_number }}
                            </td>
                            <td class="px-5">
                              @can("edit-patient")
                                <button wire:click="edit({{ $patient->id }})"
                                    class="btn btn-primary btn-sm">Edit</button>
                              @endcan

                              @can("delete-patient")
                                <button wire:click="delete({{ $patient->id }})"
                                    class="btn btn-danger btn-sm">Delete</button>
                              @endcan

                              @can("show-patient-history")
                                <button wire:click="showHistories({{ $patient->id }})"
                                    class="btn btn-warning btn-sm">{{ __('Show') }} History</button>
                              @endcan

                              @can("create-assessment")
                                <button wire:click="assessment({{ $patient->id }})"
                                    class="btn btn-success btn-sm">Assessment</button>
                              @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                {{ __('No patients found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $patients->links() }}
        </div>
    </div>
</div>

