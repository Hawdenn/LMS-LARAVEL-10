@extends('dasboard.index')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit data Guru</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/editdataguru">
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
                        <label for="nim">Nip</label>
                        <input type="number" class="form-control" id="nip" name="nip" value="{{ $data->nip }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10">{{ $data->alamat }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Edit</button>
                    <a href="/datamahasiswa" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
