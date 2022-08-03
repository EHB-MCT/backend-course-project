<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __($user->name) }}
        </h2>
    </x-slot>

    <div>
        <ul>
            <li>
                {{ $user->name }}
            </li>
            <li>
                {{ $user->email }}
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
