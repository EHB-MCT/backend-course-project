<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __($survey->survey_name) }}
        </h2>
    </x-slot>

    @foreach ($survey->questions as $question)

        <div>
            {{ $question->question }}
        </div>

    @endforeach

    <form action="{{ route('addQuestion') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="survey_id"  value="{{ $_GET['id'] }}">
        <input type="text" name="question" placeholder="someText" />
        <button type="submit">submit</button>
    </form>

</x-app-layout>
