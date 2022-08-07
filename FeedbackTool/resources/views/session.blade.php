<form action="{{ route('addSurvey') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="survey_name" placeholder="someText" />
    <button type="submit">submit</button>
</form>
