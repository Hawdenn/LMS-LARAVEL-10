<!-- resources/views/profile.blade.php -->

@extends('dasboard.index') {{-- Sesuaikan dengan layout yang Anda gunakan --}}

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Profil Pengguna
                        <a href="{{ route('edit-profile') }}" class="btn btn-sm btn-info float-right">Edit Profil</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama lengkap</th>
                                    <td>{{ $user->fullname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>{{ $user->alamat }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Umur</th>
                                    <td>{{ $user->umur }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <td>{{ $user->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Agama</th>
                                    <td>{{ $user->agama }}</td>
                                </tr>
                                {{-- Tambahkan lebih banyak informasi profil sesuai kebutuhan --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            margin-top: 20px;
        }

        .table th, .table td {
            text-align: left;
        }

        .card-header {
            font-size: 18px;
            position: relative;
        }

        .btn-info {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
        }
    </style>
@endpush
