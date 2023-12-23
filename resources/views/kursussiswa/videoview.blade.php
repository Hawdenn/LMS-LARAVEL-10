<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $data->judul }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('videojs/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('videojs/themefantasy.css') }}" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('bootstrap5/style.css') }}" rel="stylesheet">
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>

    <style>
        body {
            -webkit-user-select: none;
            /* Safari */
            -moz-user-select: none;
            /* Firefox */
            -ms-user-select: none;
            /* Internet Explorer/Edge */
            user-select: none;
            /* Standard */
            font-family: 'Nunito', sans-serif;

        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">

        <video id="my-video" class="video-js vjs-theme-fantasy vjs-matrix" controls preload="auto" width="700"
            height="364">
            <source src="{{ asset('files/' . urlencode($data->file)) }}" type="video/mp4" />
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video>
    </div>

    <script src="{{ asset('videojs/all.js') }}"></script>
    <script>
        videojs(document.querySelector('.video-js'), {
            // Video.js control bar settings
            controlBar: {
                playToggle: true, // Show the play/pause button
                volumePanel: {
                    inline: false, // Show the volume control in a separate panel
                },
                currentTimeDisplay: true, // Show the current time of the video
                timeDivider: true, // Show the time divider between current time and duration
                durationDisplay: true, // Show the total duration of the video
                progressControl: true, // Show the progress bar
                remainingTimeDisplay: true, // Show the remaining time of the video
                fullscreenToggle: true, // Show the fullscreen button
                playbackRateMenuButton: true, // Show the playback rate menu button
            },
            // Other Video.js settings
            fluid: true, // Make the video player responsive to its container
            autoplay: false, // Don't autoplay the video
            preload: 'auto', // Preload the video metadata when the page loads
            playbackRates: [0.5, 1, 1.5, 2], // Specify available playback rates
            loop: false, // Disable video looping
            muted: false, // Unmute the video (set to true to mute by default)
            language: 'en', // Set the language for Video.js controls
            // aspectRatio: '16:9', // Set the aspect ratio of the video
            controlBar: {
                children: [
                    'playToggle',
                    'volumePanel',
                    'currentTimeDisplay',
                    'timeDivider',
                    'durationDisplay',
                    'progressControl',
                    'remainingTimeDisplay',
                    'fullscreenToggle',
                    'playbackRateMenuButton'
                ],
                volumeMenuButton: {
                    inline: false, // Show the volume menu in a separate panel
                },
            },
            bigPlayButton: true, // Show the big play button in the center of the video
        });
    </script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>


    <script>
        /**
         * Disable right-click of mouse, F12 key, and save key combinations on page
         */
        var nama = "{{ auth()->user()->name }}";
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        }, false);
        document.addEventListener("keydown", function(e) {
            //document.onkeydown = function(e) {
            // "I" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                alert(nama + " Akses control + i tersebut di tolak")
                disabledEvent(e);
            }
            // "J" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                alert(nama + " Akses control + j tersebut di tolak")
                disabledEvent(e);
            }
            // "S" key + macOS
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                alert(nama + " Akses control + s tersebut di tolak")
                disabledEvent(e);
            }
            // "U" key
            if (e.ctrlKey && e.keyCode == 85) {
                alert(nama + " Akses control + u tersebut di tolak")
                disabledEvent(e);
            }
            // "F12" key
            if (event.keyCode == 123) {
                alert(nama + " Akses F12 tersebut di tolak")
                disabledEvent(e);
            }
            // "C" key
            if (e.ctrlKey && event.keyCode == 67) {
                alert(nama + " Akses Copy tersebut di tolak")
                disabledEvent(e);
            }

            // Disable Ctrl+P
            if (e.ctrlKey && e.keyCode == 80) {
                alert(nama + " Akses Print tersebut di tolak")
                disabledEvent(e);
            }

            // Disable Ctrl+PrtSc
            if (e.ctrlKey && e.keyCode == 44) {
                alert(nama + " Akses Capture tersebut di tolak")
                disabledEvent(e);
            }


            // Disable PrtSc
            if (e.keyCode == 44) {
                alert(nama + " Akses Capture tersebut di tolak")
                disabledEvent(e);
            }
        }, false);

        function disabledEvent(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            } else if (window.event) {
                window.event.cancelBubble = true;
            }
            e.preventDefault();
            return false;
        }
    </script>
</body>

</html>
