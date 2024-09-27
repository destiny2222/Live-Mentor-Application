<!DOCTYPE html>
<html>

<head>
    <!-- Other head elements -->
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.9.5/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.9.5/css/react-select.css" />
    <script src="https://source.zoom.us/2.9.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.9.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.9.5/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.9.5/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.9.5/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.9.5.min.js"></script>
</head>

<body>
    <!-- Your page content -->
    <div class="container">
        <h1>{{ $group->title }}</h1>
        <p>{{ $group->description }}</p>
        <!-- Other group details -->

        @if(Str::contains($group->video_link, 'zoom.us'))
        <div id="zmmtg-root"></div>
        <div id="aria-notify-area"></div>
        <div id="zoom-container"></div>
        @elseif($group->video_link)
        <a href="{{ $group->video_link }}" target="_blank" class="btn btn-primary">
            Join Google Meet Meeting
        </a>
        @endif
    </div>

    @if(Str::contains($group->video_link, 'zoom.us'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    ZoomMtg.setZoomJSLib('https://source.zoom.us/2.9.5/lib', '/av');
    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareWebSDK();

    // Fetch the necessary data from your backend
    fetch('/api/zoom-signature/{{ $group->id }}')
        .then(response => response.json())
        .then(data => {
            ZoomMtg.init({
                leaveUrl: '{{ route("groups.index") }}',
                success: function () {
                    ZoomMtg.join({
                        signature: data.signature,
                        meetingNumber: data.meetingNumber,
                        userName: '{{ Auth::user()->name }}',
                        apiKey: '{{ config("services.zoom.api_key") }}',
                        userEmail: '{{ Auth::user()->email }}',
                        passWord: data.password,
                        success: function () {
                            console.log('Joined the meeting');
                        },
                        error: function (error) {
                            console.log('Failed to join the meeting:', error);
                        }
                    });
                },
                error: function (error) {
                    console.log('Failed to initialize Zoom:', error);
                }
            });
        });
});
    </script>
    @endif
</body>

</html>