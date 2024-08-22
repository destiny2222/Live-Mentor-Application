<form action="{{ route('createMeeting') }}" method="post">
    @csrf
    <button type="submit">Create Meeting</button>
</form>