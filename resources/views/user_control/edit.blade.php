@extends('dasboard.index')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit user</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach ($uc as $item)
                    <form class="forms-sample" method="POST" action="/edituc" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <div class="p-2">
                                <img src="{{ asset('picture/accounts/') }}/{{ $item->gambar }}" alt="Image"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <input class="form-control" type="file" id="gambar" name="gambar">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama lengkap</label>
                            <input type="text" class="form-control" id="nama" placeholder="Kevin Example"
                                name="fullname" value="{{ $item->fullname }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Alamat</label>
                            <input type="text" class="form-control" id="nama" placeholder="alamat" name="alamat"
                                value="{{ $item->alamat }}">
                        </div>
                        <div class="form-group">
                            <label for="umur">Umur</label>
                            <input type="text" class="form-control" id="umur" placeholder="Enter Umur"
                                name="umur" value="{{ $item->umur }}">
                        </div>

                        <input type="hidden" name="password" value="{{ $item->password }}">
                        <button type="submit" class="btn btn-primary me-2">Edit</button>
                        <a href="/usercontrol" class="btn btn-light">Kembali</a>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
