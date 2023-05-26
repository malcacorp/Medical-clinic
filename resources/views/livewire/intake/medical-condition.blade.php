<div>
  <form method="POST" action="{{route('login')}}">
    @csrf
    <div class="row mb-2">
      <h3 class="text-center my-4">Would you like to schedule an appointment?</h3>
      <div class="d-flex justify-content-center">
          <input class="form-check-input" type="radio" name="appointment" id="appointment1" value="yes" onchange="handleChangeRadio(this)" checked>
          <label class="form-check-label ms-2" for="appointment1">
              Yes
          </label>
          <input class="form-check-input ms-3" type="radio" name="appointment" id="appointment2" value="no" onchange="handleChangeRadio(this)">
          <label class="form-check-label ms-2" for="appointment2">
              No
          </label>
      </div>
      <div class="form-check">
      </div>
    
      <div class="col-12 col-md-6 px-4">
          <label for="availability">Available Appointments</label>
          <select id="availability" class="form-control" wire:model="selectedDate">
              <option value="">-- Select --</option>
              @foreach ($availableDates as $availableDate)
                  <option value={{ $availableDate->id."|".$availableDate->employee_id."|".$availableDate->date."|".$availableDate->time }}>{{ $availableDate->doctorName }} | {{ $availableDate->date }} | {{ $availableDate->time }}</option>
              @endforeach
          </select>
      </div>
      <div id="medical-condition-div" class="col-12 col-md-6 px-4">
          <x-label for="medical_condition" value="{{ __('Medical Condition') }}" />
          <textarea id="medical_condition" class="form-control block mt-1 w-full" type="text" name="medical_condition"
              autocomplete="medical_condition" wire:model="medical_condition">{{ old('medical_condition') }}</textarea>
      </div>

      <input name="email" type="hidden" wire:model="email">
      <input name="password" type="hidden" wire:model="password">

    </div>
    
    <div class="mt-4 mb-0">
      <div class="d-flex justify-content-end align-items-baseline">
          <button type="button" class="btn btn-warning mx-1" wire:click.prevent="closeMedicalCondition()">
              {{ __('Back') }}
          </button>
          <button id="schedule-appointment" type="button" class="btn btn-info mx-1"  wire:click="addAppointment()">
              {{ __('Schedule appointment') }}
          </button>
          <button id="finish-button" type="submit" class="btn btn-info mx-1" style="display: none"  >
            {{ __('Finish and Log In') }}
          </button>
      </div>
      <div class="d-flex justify-content-end align-items-baseline">
        <a id="webpage-button" class="text-muted me-3 mt-3 text-decoration-none" href="http://esperanzavalencia.com/" style="display: none">
          {{ __('Go to the webpage') }}
        </a>
      </div>
    </div>
  </form>
</div>