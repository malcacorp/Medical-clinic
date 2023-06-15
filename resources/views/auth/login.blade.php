<x-guest-layout>
    <x-authentication-card>
        <div class="row">
            <div class="col-12 col-md-6 px-0 login-img" style="background-image: url({{asset('images/login-img.jpeg')}}) ">
            </div>
            <div class="col-12 col-md-6">
                <div class="card-body">
                    <h1 class="text-center mt-5 pt-4">{{ __('Welcome Back!') }}</h1>
                    <x-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="mt-5 w-75 m-auto pb-5">
                        @csrf
                        <div class="mb-3">
                            {{-- <x-label value="{{ __('Email') }}" /> --}}

                            <x-input class="{{ $errors->has('email') ? 'is-invalid' : '' }} login-input" type="email"
                                name="email" :value="old('email')" placeholder="Enter Email Address" required />
                            <x-input-error for="email"></x-input-error>
                        </div>

                        <div class="mb-3">
                            {{-- <x-label value="{{ __('Password') }}" /> --}}

                            <x-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} login-input"
                                type="password" name="password" placeholder="Password" required
                                autocomplete="current-password" />
                            <x-input-error for="password"></x-input-error>
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <x-checkbox id="remember_me" name="remember" />
                                <label class="custom-control-label" for="remember_me">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary text-white  w-100 login-input">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <hr class="my-4" />

                        {{-- <div class="mb-3">
                            <button type="button" class="btn btn-danger  text-white w-100 login-input">
                                {{ __('Login with Google') }}
                            </button>
                        </div> --}}

                        <div class="mt-4">
                            <div class="">                      
                                @if (Route::has('intake'))
                                    <a href="{{ route('intake') }}" class="btn btn-danger text-white w-100" style="line-height: 3; border-radius: 2rem">{{ __('Patient Registration') }}</a>
                                @endif                                
                            </div>
                        </div>

                        <hr class="my-4" />

                        <div class="d-flex justify-content-center">
                          @if (Route::has('password.request'))
                                    <a class="text-muted me-3" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
