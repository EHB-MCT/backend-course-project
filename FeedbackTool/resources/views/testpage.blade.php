<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Test page') }}
        </h2>
    </x-slot>

    @foreach ($user->sessions as $session)

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

</x-app-layout>
