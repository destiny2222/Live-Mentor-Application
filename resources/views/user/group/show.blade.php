@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $group->title }}</h1>
    <p>{{ $group->description }}</p>
    <!-- Other group details -->

    @if($group->video_link)
        <a href="{{ $group->video_link }}" target="_blank" class="btn btn-primary">
            Join {{ Str::contains($group->video_link, 'meet.google.com') ? 'Google Meet' : 'Zoom' }} Meeting
        </a>
    @endif
</div>
@endsection