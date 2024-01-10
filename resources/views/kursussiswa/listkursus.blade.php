@extends('dasboard.index')

@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="d-flex justify-content-start mt-3">
            <a href="{{ route('kursuslist') }}" class="btn btn-primary">Kembali</a>
        </div>


        <div class="card-body">
            <div class="container mt-3">
                <div class="col-12">
                    <!-- Back button -->

                    <div class="row">
                        @forelse ($materi as $val)
                            <div class="col-auto mb-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-header bg-primary">
                                        @php
                                            $tmp = explode('.', $val->file);
                                            $extension = end($tmp);

                                        @endphp
                                        @if ($extension != 'pdf')
                                            <a href="{{ route('courses-show-video', ['id' => $val->id]) }}" target="_BLANK">
                                                <b style="color: white">{{ $val->title ?? 'null' }}</b></a>
                                        @else
                                            <a href="{{ route('courses-show-pdf', ['id' => $val->id]) }}" target="_BLANK">
                                                <b style="color: white">{{ $val->title ?? 'null' }}</b></a>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $val->name }}</h5>
                                        @if (isset($val->file) && $val->file != '')
                                            {{-- <iframe
                                    src="{{ asset('files/' . urlencode($val->files)) . '#page=1#disabledownload=true&disableprint=true&disableshare=true' . '?embedded=true' }}"
                                    frameborder="0" disallowfullscreen style="width: 100%; height: 100%;" scrolling="no"
                                    style="overflow: hidden;pointer-events: none;"></iframe> --}}
                                            @if ($extension != 'pdf')
                                                <a href="{{ route('courses-show-video', ['id' => $val->id]) }}"
                                                    target="_BLANK">
                                                    <img src="{{ asset('images/videopng.png') }}" alt=""
                                                        style="width: 100%; height: 150px; object-fit: contain;"></a>
                                            @else
                                                <a href="{{ route('courses-show-pdf', ['id' => $val->id]) }}"
                                                    target="_BLANK">
                                                    <img src="{{ asset('images/pdfview.png') }}" alt=""
                                                        style="width: 100%; height: 150px; object-fit: contain;"></a>
                                            @endif
                                        @else
                                            <a href="#" target="_BLANK">
                                                <img src="{{ asset('images/pdfview.png') }}" alt=""
                                                    style="width: 100%; height: 150px; object-fit: contain;"></a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="d-flex justify-content-center mt-5">

                                <div class="text-center">
                                    <h5>Tidak ada data kursus untuk guru tersebut</h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {!! $materi->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmHapus(event) {
        event.preventDefault(); // Menghentikan form dari pengiriman langsung

        Swal.fire({
            title: 'Yakin Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                event.target.submit(); // Melanjutkan pengiriman form
            } else {
                Swal('Your imaginary file is safe!');
            }
        });
    }
</script>
