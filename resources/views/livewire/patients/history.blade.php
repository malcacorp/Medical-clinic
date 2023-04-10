<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
              {{-- <x-validation-errors class="mb-4" /> --}}
              <div class="row">
                <div class="col text-center">
                  <h2>Date: <strong>{{$historyToShow->date}}</strong></h2>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col">
                  <h3>Doctor: <strong>{{$historyToShow->doctorName ? $historyToShow->doctorName : null}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Patients's Medical Condition: <strong>{{$historyToShow->diagnostic}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Treatment and Prescription: <strong>{{$historyToShow->treatment}}</strong></h3>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col">
                  <h3>Nurse: <strong>{{$historyToShow->nurseName ? $historyToShow->nurseName : null}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Initial Medical Condition: <strong>{{$historyToShow->medical_condition}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Blood Pressure: <strong>{{$historyToShow->blood_pressure}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Temperature: <strong>{{$historyToShow->temperature}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Weight: <strong>{{$historyToShow->weight}}</strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Height: <strong>{{$historyToShow->height}}</strong></h3>
                </div>
              </div>
              <hr>
            </div>
      </div>
  </div>
</div>
