<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __($client->name) }}
        </h2>
    </x-slot>

    <div>
        <ul>
            <li>
                {{ $client->name }}
            </li>
            <li>
                {{ $client->email }}
            </li>
        </ul>
    </div>

    <div>
        {{--TODO--}}
        {{--Insert client stats here--}}
        <b><i>
            Hier komt de statistiek
        </i></b>
    </div>

</x-app-layout>
