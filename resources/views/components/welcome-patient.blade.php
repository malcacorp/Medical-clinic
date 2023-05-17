<div>
  <div class="card shadow mb-4">
      <div class="card-body">
          <h2>Hello, {{ Auth::user()->name }}</h2>

          <h3>Welcome to clinic Hope Valencia</h3>

          <div class="text-center">
              <a class="btn btn-primary btn-lg my-5  mx-5 text-white" href="{{ route('schedule') }}">Book Appointment</a>
              <a class="btn btn-primary btn-lg my-5  mx-5 text-white" href="{{ route('profile.show') }}">Update Profile</a>
          </div>
          <div class="text-center">
              <h2>Next Appointment</h2>
          </div>

          <div class="d-flex">
              <div class="flex-grow-1">
                  <h4>Doctor: Freddy 1/20/2023 at 4:pm</h4>
              </div>
              <div class="flex-grow-1 text-center"><button class="btn btn-secondary text-white text-right">Cancel
                      Appointment</button>
              </div>
          </div>

      </div>
  </div>
</div>