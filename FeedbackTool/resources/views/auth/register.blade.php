<x-guest-layout>
    <x-auth-card>
        <p class="center title">
            {{ __('Register') }}
        </p>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <label>
                <x-label for="name" :value="__('Name*')" />
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
            </label>

            <!-- Email Address -->
            <label>
                <x-label for="email" :value="__('Email*')" />
                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </label>

            <!-- Password -->
            <label>
                <x-label for="password" :value="__('Password*')" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </label>

            <!-- Confirm Password -->
            <label>
                <x-label for="password_confirmation" :value="__('Confirm password*')" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required />
            </label>

            <div class="half">
                <button type="submit" class="registerSubmit">
                    {{ __('Register') }}
                </button>

                <a href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

        </form>
    </x-auth-card>
</x-guest-layout>
