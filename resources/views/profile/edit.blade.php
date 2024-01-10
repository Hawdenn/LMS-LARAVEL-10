<!-- resources/views/profile/edit.blade.php -->

@extends('dasboard.index') {{-- Adjust the layout name based on your application's layout --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Your Profile
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.change') }}" enctype="multipart/form-data">
                            @csrf

                           <!-- Full Name -->
<div class="form-group">
    <label for="fullname">Full Name</label>
    <input type="text" class="form-control" id="fullname" name="fullname"
        value="{{ old('fullname', $user->fullname) }}">
    @error('fullname')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Email -->
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email"
        value="{{ old('email', $user->email) }}">
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Alamat -->
<div class="form-group">
    <label for="alamat">Alamat</label>
    <input type="text" class="form-control" id="alamat" name="alamat"
        value="{{ old('alamat', $user->alamat) }}">
    @error('alamat')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Jenis Kelamin -->
<div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
        <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
            Laki-laki</option>
        <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
            Perempuan</option>
    </select>
    @error('jenis_kelamin')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Agama -->
<div class="form-group">
    <label for="agama">Agama</label>
    <select class="form-control" id="agama" name="agama">
        <option value="Islam" {{ old('agama', $user->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
        <option value="Kristen" {{ old('agama', $user->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
        <option value="Hindu" {{ old('agama', $user->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
        <option value="Buddha" {{ old('agama', $user->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
        <option value="Konghucu" {{ old('agama', $user->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
        <!-- Add more options based on your needs -->
    </select>
    @error('agama')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Umur -->
<div class="form-group">
    <label for="umur">Umur</label>
    <input type="text" class="form-control" id="umur" name="umur"
        value="{{ old('umur', $user->umur) }}">
    @error('umur')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Gambar -->
<div class="form-group">
    <label for="gambar">Gambar</label>
    <input type="file" class="form-control" id="gambar" name="gambar">
    @error('gambar')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


                            <!-- Back Button -->
                            <a href="{{ route('profile') }}" class="btn btn-secondary">Back</a>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
