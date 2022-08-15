<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        You're logged in!
    </div>

    @if(!$sessions || $sessions->count() == 0 || Auth::user()->can('moderate'))
        <div>
            Nothing to fill in!
        </div>
    @else
        <div>
            There's an open session for you.
        </div>
        @foreach($sessions as $session)
            <a href="{{ route('session', ['id' => $session->id]) }}">
                <div>
                    {{ $session->survlist[0]->list_name }}
                </div>
                <div>
                    <i class="fas fa-plus"></i>
                </div>
            </a>
        @endforeach
    @endif

</x-app-layout>
