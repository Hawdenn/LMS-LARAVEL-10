@extends('dasboard.index')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit data DAMA</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/editdama">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="nama">Name</label>
                        <input type="text" class="form-control" id="nama" name="name" value="{{ $data->name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" name="email"
                            value="{{ $data->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nim">Nim</label>
                        <input type="number" class="form-control" id="nim" name="nim" value="{{ $data->nim }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input type="number" class="form-control" id="angkatan" name="angkatan"
                            value="{{ $data->angkatan }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan"
                            value="{{ $data->jurusan }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Edit</button>
                    <a href="/datamahasiswa" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
