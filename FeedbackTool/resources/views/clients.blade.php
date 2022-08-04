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

        <h2>
            {{ __('Admins') }}
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
                <h2>
                    {{ __('Caretakers') }}
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

            <h2>
                {{ __('Clients') }}
            </h2>
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

</x-app-layout>
