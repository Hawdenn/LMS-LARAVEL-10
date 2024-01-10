@extends('dasboard.index')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah data GURU</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/tambahdataguru" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Name</label>
                        <input type="text" class="form-control" id="nama" placeholder="Kevin Example" name="name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="kevin@example.com"
                            name="email" required>
                    </div>
                    <div class="form-group">`
                        <label for="nim">Nip</label>
                        <input type="number" class="form-control" id="nip" placeholder="22020000" name="nip"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10"></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <a href="/datamahasiswa" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
