<div class="col-md-6 offset-md-3">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row mb-2">
            <h3 class="text-center my-4">{{ __('Would you like to schedule an appointment?') }}</h3>
            <div class="d-flex justify-content-center">
                <input class="form-check-input" type="radio" name="appointment" id="appointment1" value="yes"
                    onchange="handleChangeRadio(this)" checked>
                <label class="form-check-label ms-2" for="appointment1">
                    Yes
                </label>
                <input class="form-check-input ms-3" type="radio" name="appointment" id="appointment2" value="no"
                    onchange="handleChangeRadio(this)">
                <label class="form-check-label ms-2" for="appointment2">
                    No
                </label>
            </div>

            <div id="calendar-div" class="col-12 px-4">                
                @if (count($availableDates)==0)
                    <div class="alert alert-warning" role="alert">
                        {{ __('There are no available appointments') }}
                    </div>
                @else
                    <label for="availability">{{ __('Available Appointments') }}</label>
                    <select id="availability" class="form-control w-100 mw-100" wire:model="selectedDate">
                        <option value="">--{{ __('Select') }}--</option>
                        @foreach ($availableDates as $availableDate)
                            <option
                                value={{ $availableDate->id . '|' . $availableDate->employee_id . '|' . $availableDate->date . '|' . $availableDate->time }}>
                                {{ $availableDate->doctorName }} | {{ $availableDate->date }} |
                                {{ $availableDate->time }}</option>
                        @endforeach
                    </select>
                    <x-label for="medical_condition" value="{{ __('Medical Condition') }}" />
                    <textarea id="medical_condition" class="form-control block mt-1 w-full" type="text" name="medical_condition"
                        autocomplete="medical_condition" wire:model="medical_condition">{{ old('medical_condition') }}</textarea>
                @endif
            </div>

            <input name="email" type="hidden" wire:model="email">
            <input name="password" type="hidden" wire:model="password">

        </div>

        <div class="mt-4 mb-0">
            <div class="d-flex justify-content-end align-items-baseline">
                <button type="button" class="btn btn-warning mx-1" wire:click.prevent="closeMedicalCondition()">
                    {{ __('Back') }}
                </button>
                <div id="yes-buttons">
                    @if (count($availableDates)==0)
                        <button id="finish-button" type="submit" class="btn btn-info mx-1">
                            {{ __('Finish and Log In') }}
                        </button>
                    @else
                        <button id="schedule-appointment" type="button" class="btn btn-info mx-1"
                            wire:click="addAppointment()">
                            {{ __('Schedule appointment') }}
                        </button>
                    @endif
                </div>
                <div id="no-buttons" style="display: none">
                    <button id="finish-button" type="submit" class="btn btn-info mx-1">
                        {{ __('Finish and Log In') }}
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-baseline">
                <a id="webpage-button" class="text-muted me-3 mt-3 text-decoration-none"
                    href="http://esperanzavalencia.com/" style="display: none">
                    {{ __('Go to the webpage') }}
                </a>
            </div>
        </div>
    </form>
</div>
