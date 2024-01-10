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
    <object data="{{ asset('files/' . $data->file) }}" type="application/pdf" width="100%" height="100%">
        <p>Unable to display PDF file. <a href="{{ asset('files/' . $data->file) }}">Download</a> instead.
        </p>
    </object>


</html>
