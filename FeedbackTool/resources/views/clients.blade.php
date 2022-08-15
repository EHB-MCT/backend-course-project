<x-app-layout>
    <x-slot name="header">
        @if(request()->is('clients'))
            <h2>
                {{ __('Users') }}
            </h2>
        @else
            <h2>
                {{ __('Statistics') }}
            </h2>
        @endif
    </x-slot>

    @can('admin')
        <h2>
            {{ __('Admins') }}
        </h2>
        @foreach ($users->admins as $admin)
            <a href="{{ route('client', ['id' => $admin->id]) }}">

                <div>
                    {{ $admin->name }}
                </div>
                <div>
                    <i class="fas fa-plus"></i>
                </div>

            </a>

        @endforeach
        </br>
        </br>
        <h2>
            {{ __('Moderators') }}
        </h2>
        @foreach ($users->moderators as $mod)
            <a href="{{ route('client', ['id' => $mod->id]) }}">

                <div>
                    {{ $mod->name }}
                </div>
                <div>
                    <i class="fas fa-plus"></i>
                </div>

            </a>

        @endforeach

    @endcan

    @can('caretaker')

        @foreach ($users->caretakers as $caretaker)

            @can('moderate')
                </br>
                </br>
                <h2>
                    {{ __('Caretaker') }}
                </h2>
            @endcan

            @if ($caretaker->id != Auth::user()->getAuthIdentifier())
                <a href="{{ route('client', ['id' => $caretaker->id]) }}">

                    <div>
                        {{ $caretaker->name }}
                    </div>
                    <div>
                        <i class="fas fa-plus"></i>
                    </div>

                </a>
            @endif
            </br>
            <h3>
                {{ __('Clients') }}
            </h3>
            @foreach ($caretaker->clients as $client)
                <a href="{{ route('client', ['id' => $client->id]) }}">

                    <div>
                        {{ $client->name }}
                    </div>
                    <div>
                        <i class="fas fa-plus"></i>
                    </div>

                </a>

            @endforeach

        @endforeach

    @endcan

    @foreach ($users as $user)

        <a href="{{ route('client', ['id' => $user->id]) }}">

            <div>
                {{ $user->name }}
            </div>
            <div>
                <i class="fas fa-plus"></i>
            </div>

        </a>

    @endforeach

    @if(request()->is('clients'))
        <x-auth-card>
            <form method="POST" action="{{ route('newRegister') }}">
            @csrf

                @if(Auth::user()->can('admin'))
                    <p class="center title">
                        {{ __('Register someone else') }}
                    </p>
                @elseif(Auth::user()->can('moderate'))
                    <p class="center title">
                        {{ __('Register a caretaker') }}
                    </p>
                @elseif(Auth::user()->can('caretaker'))
                    <p class="center title">
                        {{ __('Register a client') }}
                    </p>
                @endif

                <!-- Validation Errors -->
                <x-auth-validation-errors :errors="$errors" />

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
                </div>

            </form>
        </x-auth-card>
    @endif

</x-app-layout>
