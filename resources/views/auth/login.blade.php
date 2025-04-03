<x-guest-layout>
    <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100">
                    <div class="col-xl-4 col-lg-4 col-md-4 m-auto">
                        <div class="authentication-form mx-auto">
                            <div class="text-center">
                                <h2 class="mt-2 f-22 text-uppercase"><b>{{ __('Portal Login') }}</b></h2>
                                <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>
                            </div>
                            
                            <form method="POST" action="{{ route('login') }}">
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

                                <!-- Username -->
                                <div class="form-group">
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <i class="ik ik-user"></i>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <i class="ik ik-lock"></i>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mt-2">
                                    <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember" value="option1">
                                            <span class="custom-control-label">&nbsp;{{ __('Remember Me') }}</span>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-dark btn-block pb-4">
                                        {{ __('Login') }}
                                        <span class="iconify" data-icon="feather:arrow-right-circle"></span>
                                    </button>
                                </div>
                            </form>

                                <div class="text-sm mt-3">
                                    {{ __('Don\'t have an account?') }} <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-guest-layout>
