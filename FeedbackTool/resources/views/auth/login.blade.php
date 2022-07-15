<x-guest-layout>
    <x-auth-card>
        <p class="center title">
            {{ __('Login') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" class="loginForm" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <label>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            </label>

            <!-- Password -->
            <label>
                <x-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="forgotPassword" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </label>


            <!-- Remember Me -->
            <label class="remember">
                <span>{{ __('Remember me') }}</span>
                <input id="remember_me" type="checkbox" name="remember">
            </label>

            <div class="half">
                <button type="submit" class="loginSubmit">
                    {{ __('Log in') }}
                </button>

                <a href="{{ route('register') }}">
                    {{ __("Don't have an account?") }}
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
