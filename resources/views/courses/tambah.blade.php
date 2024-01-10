@extends('dasboard.index')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah data Courses</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/coursestambah" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Name</label>
                        <input type="text" class="form-control" id="nama" placeholder="Kevin Example" name="name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="kevin@example.com"
                            name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="nim">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>

                    </div>
                    <div class="form-group">
                        <label for="angkatan">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="form-group">
                        <label for="jurusan">File Pdf</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <a href="/courses" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
