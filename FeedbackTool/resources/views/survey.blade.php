<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($survey->survey_name) }}
        </h2>
    </x-slot>

    @foreach ($survey->questions as $question)

        <div>
            {{ $question->question }}
        </div>

    @endforeach

</x-app-layout>
