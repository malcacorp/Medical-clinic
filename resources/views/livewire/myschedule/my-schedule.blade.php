<div>
    @if (session()->has('message'))
        <div class="alert alert-info" role="alert">
            <div class="flex">
                {{ session('message') }}</p>
            </div>
        </div>
    @endif
    <x-slot name="header" class="">
        <h2 class="ms-4 h1 items-center text-center">
            {{ __('Work Schedule') }}
        </h2>
    </x-slot>
    <div class="card shadow container mb-4 w-50">
        <div class="card-body w-100">
            <table class="table table_schedule">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ----------------------------------- --}}
                    <tr>
                        <td>
                            <h4 class="text-md">Monday</h4>
                        </td>
                        <td>
                            <div class="row">

                                <div class="input-group flex-column: align-items-center col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="mon_am"
                                        wire:model="data.Monday.start">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group flex-column: align-items-center col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="mon_pm"
                                        wire:model="data.Monday.end">
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- ----------------------------------- --}}
                    <tr>
                        <td>
                            <h4> Tuesday</h4>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="tue_am"
                                        wire:model="data.Tuesday.start">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="tue_pm"
                                        wire:model="data.Tuesday.end">
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- ----------------------------------- --}}
                    <tr>
                        <td>
                            <h4>Wednesday</h4>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="wed_am"
                                        wire:model="data.Wednesday.start">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="wed_pm"
                                        wire:model="data.Wednesday.end">
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- ----------------------------------- --}}
                    <tr>
                        <td>
                            <h4>Thursday</h4>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="thu_am"
                                        wire:model="data.Thursday.start">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="thu_pm"
                                        wire:model="data.Thursday.end">
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- ----------------------------------- --}}
                    <tr>
                        <td>
                            <h4>Friday</h4>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="fri_am"
                                        wire:model="data.Friday.start">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="fri_pm"
                                        wire:model="data.Friday.end">
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- ----------------------------------- --}}
                    <tr>
                        <td>
                            <h4>Saturday</h4>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="sat_am"
                                        wire:model="data.Saturday.start">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="sat_pm"
                                        wire:model="data.Saturday.end">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Sunday</h4>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input" name="sun_am"
                                        wire:model="data.Sunday.start">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group col-sm-8 col-md-6">
                                    <input type="time" step="1800" class="form-control small-input"
                                        name="sun_pm" wire:model="data.Sunday.end">
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="display: flex; justify-content: center; align-items: center;">
        <button class="btn btn-primary text-white py-1 m-4 px-3 rounded" wire:click="store()">Submit</button>
    </div>
</div>

@push('scripts')
    <script>
        var inputs = document.querySelectorAll('input[type="time"]');

        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                var value = this.value;
                var minutes = value.substr(3, 2);
                if(minutes >= 30) {
                    this.value = value.substr(0, 3) + '30';
                }else {
                    this.value = value.substr(0, 3) + '00';
                }
            });
        });
    </script>
@endpush
