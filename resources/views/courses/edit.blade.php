@extends('dasboard.index')

@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit data COURSES</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/editcourses">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Kevin Example" name="name"
                            required value="{{ $data->name }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="kevin@example.com"
                            name="title" value="{{ $data->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea value="{{ $data->description }}">

                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" value="{{ $data->photo }}">
                    </div>
                    <div class="form-group">
                        <label for="jurusan">File Pdf</label>
                        <input type="file" class="form-control" id="file" name="file" value="{{ $data->file }}">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Edit</button>
                    <a href="/courses" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
