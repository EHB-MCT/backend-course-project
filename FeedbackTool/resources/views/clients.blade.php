<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Client') }}
        </h2>
    </x-slot>

    @foreach ($clients as $client)

        <a href="{{ route('client', ['id' => $client->id]) }}">

            <div>
                {{ $client->name }}
            </div>
            <div>
                <i class="fas fa-plus"></i>
            </div>

        </a>

    @endforeach

</x-app-layout>
