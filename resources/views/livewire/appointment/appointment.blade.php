<x-slot name="header">
    <h2 class="ms-4 h3">
        {{ __('Appointment') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                <div class="row">

                    <div class="col col-md-5 aling-items-center">
                        <form style="display: block">

                            {{-- Data and time --}}
                            <label for="appointment-reason">Date and time</label>
                            <input type="datetime-local" class="form-control" id="">

                            {{-- Select Doctor --}}
                            <label for="doctor">Select doctor</label>
                            <select id="doctorSelected" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach ($doctors as $doctor)
                              <option value={{$doctor->id}}>{{ $doctor->first_name }}</option>
                              @endforeach
                            </select>

                            {{-- Reason --}}
                            <label for="appointment-reason">Reason for medical appointment</label>
                            <textarea type="text" class="form-control" id="appointment-reason" placeholder="Reason for medical appointment"></textarea>

                            {{-- Button --}}
                            <div class="flex justify-content-center mt-4">
                                <button class="btn btn-dark text-white" type="button">
                                    {{ __('Delete appointment') }}
                                </button>
                                <button class="btn btn-danger text-white" type="button">
                                    {{ __('Back') }}
                                </button>
                                <button class="btn btn-success text-white" type="button">
                                    {{ __('Submit') }}
                                </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
