@extends('dasboard.index')

@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Guru</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p> --}}

        {{-- <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary mb-4">DataTables Example</h6> --}}


        <a href="/datagurutambah" class="btn btn-primary me-2">Tambah data</a>

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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Nip</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Nip</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>

                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nip }}</td>
                            <td>{{ $item->alamat }}</td>

                            <td><a href="/dataguruedit/{{ $item->id }}"class="btn btn-primary me-2">Edit</a>
                                |
                                <form onsubmit="return confirmHapus(event)" action="/dataguruhapus/{{ $item->id }}"
                                    method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger me-2">Hapus</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
