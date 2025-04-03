<section class="space-y-6">

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h5 class="text-md">
                {{ __('Are you sure you want to delete your account?') }}
            </h5>

            <p class="mt-1 text-sm">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />
            </div>

            <div class="mt-3">
                <button class="btn btn-danger">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
</section>
