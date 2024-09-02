<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Zoom Meeting</title>
    <script src="https://source.zoom.us/2.0.1/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.0.1/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.0.1/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.0.1/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.0.1.min.js"></script>
</head>
<body>
    <div id="zmmtg-root"></div>
    <script>
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.0.1/lib', '/av');
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();

        ZoomMtg.init({
            leaveUrl: '{{ url('/') }}', // Redirect users when they leave the meeting
            success: function() {
                ZoomMtg.join({
                    meetingNumber: '{{ $meetingId }}',
                    userName: '{{ $userName }}',
                    signature: '{{ $signature }}',
                    apiKey: '{{ $apiKey }}',
                    userEmail: '{{ $userEmail }}',
                    passWord: '{{ $password }}',
                    success: function(res) {
                        console.log('Join meeting success');
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            error: function(res) {
                console.log(res);
            }
        });
    </script>
</body>
</html>
