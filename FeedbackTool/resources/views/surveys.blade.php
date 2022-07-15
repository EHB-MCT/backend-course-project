<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Survey') }}
        </h2>
    </x-slot>

    @foreach ($surveys as $survey)

        <a href="{{ route('survey', ['id' => $survey->id]) }}">

            <div>
                {{ $survey->survey_name }}
            </div>
            <div>
                <i class="fas fa-plus"></i>
            </div>

        </a>

    @endforeach

</x-app-layout>
