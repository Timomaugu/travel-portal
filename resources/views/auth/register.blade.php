<x-guest-layout>
    <div class="auth-wrapper ">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100">
                    <div class="col-xl-4 col-lg-4 col-md-4 m-auto">
                        <div class="authentication-form mx-auto">
                            <div class="text-center">
                                <h2 class="mt-2 f-22 text-uppercase"><b>{{ __('Registration') }}</b></h2>
                                <p class="login-box-msg">{{ __('Register to login into system') }}</p>
                            </div>
                            
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger mt-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- First Name -->
                                <div class="form-group">
                                    <input id="fname" type="name" placeholder="First Name" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>
                                    <i class="ik ik-user"></i>
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="form-group">
                                    <input id="lname" type="name" placeholder="Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                                    <i class="ik ik-user"></i>
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <i class="ik ik-mail"></i>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex">
                                    <!-- Phone -->
                                    <div class="form-group mr-3">
                                        <input id="phone" type="phone" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                        <i class="ik ik-phone"></i>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Department -->
                                    <div class="form-group">
                                        <select id="department" class="form-control @error('department') is-invalid @enderror" name="department" required autocomplete="department">
                                            <option value="">Select Department</option>
                                           
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="ik ik-home"></i>
                                        @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <!-- Password -->
                                    <div class="form-group mr-3">
                                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <i class="ik ik-lock"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
                                        <i class="ik ik-lock"></i>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm">
                                        <button class="btn btn-dark btn-block">
                                            {{ __('Register') }}
                                            <span class="iconify" data-icon="feather:arrow-right-circle"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-3">
                                <p>{{ __('Already registered?')}} <a href="{{url('login')}}">{{ __('Sign In')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-guest-layout>
