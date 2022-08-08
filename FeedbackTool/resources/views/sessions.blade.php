<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Sessions') }}
        </h2>
    </x-slot>

    </br>
    <h2>
        {{ __('Survey lists') }}
    </h2>

    @foreach ($user->survlists as $survlist)
        </br>
        <h2>
            survey list listname = {{ $survlist->list_name }}
        </h2>
        <ul>
            @foreach($survlist->surveys as $survey)
                <li>
                    {{ $survey->survey_name }}
                </li>
            @endforeach
        </ul>
    @endforeach

    </br>
    <h2>
        {{ __('New survey lists') }}
    </h2>
    <form action="{{ route('addSurvlist') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="list_name" placeholder="survey list name" />
        <input type="text" name="description" placeholder="description" />
        @foreach ($user->surveys as $survey)
            <input type="checkbox" name="survey{{ $survey->id }}">{{ $survey->survey_name }}</input>
        @endforeach
        <button type="submit">submit</button>
    </form>

    </br></br></br>
    <h2>
        Active sessions
    </h2>
    @foreach ($user->sessions as $session)
        </br></br>
        <h2>
            client_id = {{ $session->client_id }}
        </h2>
        </br>
        <ul>
            <h3>
                survey list for this client = {{ $session->survlist[0]->list_name }}
            </h3>
            </br>
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
                </br>
            @endforeach
        </ul>
    @endforeach

    </br>
    <h2>
        {{ __('New survey lists') }}
    </h2>
    </br>
    <form action="{{ route('addSession') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <select name="client">
            @foreach($user->clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
        <select name="survlist">
            @foreach($user->survlists as $survlist)
                <option value="{{ $survlist->id }}">{{ $survlist->list_name }}</option>
            @endforeach
        </select>

        <button type="submit">submit</button>
    </form>

</x-app-layout>
