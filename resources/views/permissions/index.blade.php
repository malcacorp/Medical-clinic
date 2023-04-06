<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Permission') }}
        </h2>
    </x-slot>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>                            
                            <th> </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>
                                <td whitespace-nowrap">
                                    {{ $permission->id }}
                                </td>
                                <td whitespace-nowrap">
                                    {{ $permission->name }}
                                </td>
                                <td class="px-5">
                                    <button wire:click="edit({{ $permission->id }})"
                                        class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $permission->id }})"
                                        class="btn btn-danger btn-sm">Delete</button>                                    
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="2" class="px-5 font-medium text-gray-900 whitespace-nowrap">
                                    {{ __('No permissions found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
