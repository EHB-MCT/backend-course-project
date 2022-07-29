<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Survey') }}
        </h2>
    </x-slot>

    @foreach ($users as $user)

        <a href="{{ route('clients', ['id' => $user->id]) }}">

            <div>
                {{ $user->name }}
            </div>
            <div>
                <i class="fas fa-plus"></i>
            </div>

        </a>

    @endforeach

</x-app-layout>
