<!DOCTYPE html>
<html>

<head>
    <title>{{ $data->judul }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('pdfjs/web/viewer.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('pdfjs/web/viewer.js') }}"></script>
    <script src="{{ asset('pdfjs/build/pdf.min.js') }}"></script>
    {{-- <script src="{{ asset('pdfjs/build/pdf.worker.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script> --}}
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

        .pdf-page-container {
            max-width: 1100px;
            margin: 10px auto;

        }
    </style>
</head>

<body>
    <div class="container">

        <div class="pdf-page-container">

            <div class="pdf-page"></div>
        </div>
    </div>
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
        // PDF.js configuration
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "{{ asset('pdfjs/build/pdf.worker.min.js') }}";
        const pdfUrl = "{{ asset('files/' . $data->file) }}";
        const pdfLoadingTask = pdfjsLib.getDocument(pdfUrl);

        pdfLoadingTask.promise.then(pdf => {
            // Page container
            const pageContainer = document.querySelector('.pdf-page');
            // Add canvases for each page
            for (let i = 1; i <= pdf.numPages; i++) {
                pdf.getPage(i).then(page => {
                    const canvas = document.createElement('canvas');
                    const viewport = page.getViewport({
                        scale: 1.5
                    });
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    page.render({
                        canvasContext: context,
                        viewport: viewport
                    });
                    pageContainer.appendChild(canvas);
                });
            }

        });

        // Render initial page
        function renderPage() {
            const canvasList = document.querySelectorAll('.pdf-page canvas');
            const currentPageCanvas = canvasList[currentPageNumber - 1];
            // Scroll to top of page
            pageContainer.scrollTop = currentPageCanvas.offsetTop;
            // Show only current page
            canvasList.forEach(canvas => canvas.classList.remove('pdf-page-active'));
            currentPageCanvas.classList.add('pdf-page-active');
            // Disable "Prev" button on first page
            prevButton.disabled = currentPageNumber === 1;
            // Disable "Next" button on last page
            nextButton.disabled = currentPageNumber === pdf.numPages;
            // Update page number input
            pageNumberInput.value = currentPageNumber;
        }
        renderPage();
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
