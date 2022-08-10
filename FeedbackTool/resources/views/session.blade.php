<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Session') }}
        </h2>
    </x-slot>
    @if($question)

        {{ $question->question }}

        <form action="{{ route('addResponse') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <input type="hidden" name="session_id" value="{{ $_GET['id'] }}">

            <input type="range" name="score" min="0" max="10" required>

            <button type="submit">submit</button>
        </form>
    @else
        <a href="{{ route('welcome') }}">Done</a>
    @endif

</x-app-layout>
