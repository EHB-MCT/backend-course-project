<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Sessions') }}
        </h2>
    </x-slot>

    <form action="{{ route('addSurvlist') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="list_name" placeholder="survey list name" />
        <input type="text" name="description" placeholder="description" />
        @foreach ($user->surveys as $survey)
            <input type="checkbox" name="survey{{ $survey->id }}">{{ $survey->survey_name }}</input>
        @endforeach
        <button type="submit">submit</button>
    </form>

{{--    @foreach ($user->surveys as $survey)--}}
{{--        </br>--}}
{{--        <h3>--}}
{{--            Name = {{ $survey->survey_name }}--}}
{{--        </h3>--}}
{{--        </br>--}}
{{--        <ol>--}}
{{--            @foreach($survey->questions as $question)--}}
{{--                <li>--}}
{{--                    {{ $question->question }}--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ol>--}}
{{--        </br>--}}
{{--    @endforeach--}}

    @foreach ($user->sessions as $session)
        </br></br></br>
        <h2>
            session_id = {{ $session->id }}
        </h2>
        </br>
        <ul>
            <h3>
                survey list name = {{ $session->survlist[0]->list_name }}
            </h3>
            </br></br></br>
            @foreach($session->surveys as $survey)
                <li>
                    survey name = {{ $survey->survey_name }}
                    <ol>
                        @foreach($survey->questions as $question)
                            <li>
                                {{ $question->question }}
                            </li>
                        @endforeach
                    </ol>
                </li>
                </br></br></br>
            @endforeach
        </ul>

    @endforeach

{{--    <form action="{{ route('addSurvey') }}" method="POST" enctype="multipart/form-data">--}}
{{--        @csrf--}}

{{--        <input type="text" name="survey_name" placeholder="someText" />--}}
{{--        <button type="submit">submit</button>--}}
{{--    </form>--}}

</x-app-layout>
