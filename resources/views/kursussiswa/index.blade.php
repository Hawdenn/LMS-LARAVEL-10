@extends('dasboard.index')

@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Guru Yang Memiliki Courses</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p> --}}

        {{-- <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary mb-4">DataTables Example</h6> --}}



        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire(
                        'Sukses',
                        '{{ Session::get('success') }}',
                        'success'
                    );
                });
            </script>
        @endif
    </div>
    <div class="card-body ">
        <div class="container mt-3 ">
            <div class="col-12">
                <div class="row">
                    @forelse ($guru as $val)
                        <div class="col-auto mb-3 ">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $val->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $val->nip }}</h6>
                                    <p class="card-text">{{ $val->alamat }}</p>
                                    <a href="{{ route('kursuslistguru', ['id' => $val->id]) }}" class="card-link">List
                                        Materi Kursus</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center mt-5">

                            <div class="text-center">
                                <h5>Tidak ada data guru</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {!! $guru->withQueryString()->links('pagination::bootstrap-5') !!}
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
