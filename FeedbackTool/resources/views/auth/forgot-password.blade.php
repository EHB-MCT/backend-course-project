<x-guest-layout>
    <x-auth-card>
        <p class="center title">
            {{ __('Forgot password') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label>
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </label>

            <!-- Email Address -->
            <label>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            </label>

            <div class="half">
                <button type="submit" class="updatePasswordSubmit">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
