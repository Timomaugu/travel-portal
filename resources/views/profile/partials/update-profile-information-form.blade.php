<section>
    <p class="mt-1 text-sm text-gray-600">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="f_name">{{__('First Name') }} </label>
            <input id="f_name" name="f_name" type="text" class="form-control" value="{{ old('fname', $user->f_name) }}" required autofocus autocomplete="f_name" />
            @error('f_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="l_name">{{__('Last Name') }} </label>
            <input id="l_name" name="l_name" type="text" class="form-control" value="{{ old('lname', $user->l_name) }}" required autofocus autocomplete="l_name" />
            @error('l_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{__('Email') }} </label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }} " disabled />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="row">
            <!-- Phone Number -->
            <div class="col-sm form-group">
                <label for="phone">{{ __('Phone') }} </label>
                <input id="phone" class="form-control" type="phone" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="mobile"/>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!-- Department -->
            <div class="col-sm form-group">
                <label for="department">{{ __('Department') }} </label>
                <select id="department" class="form-control @error('department') is-invalid @enderror" name="department" autocomplete="department">
                    <option value="">Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ ($user->department_id == $department->id) ? 'selected':'' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class=" mt-3">
            <button class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</section>
