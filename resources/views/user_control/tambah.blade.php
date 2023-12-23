@extends('dasboard.index')
@section('navitem')
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('usercontrol') }}">User Control</a>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="{{ route('datamahasiswa') }}">Data Mahasiswa</a>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
@endsection
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah User</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/tambahuc" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama lengkap</label>
                        <input type="text" class="form-control" id="nama" placeholder="Kevin Example"
                            name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email"
                            name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail3" placeholder="Password"
                            name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="label-input100">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="umur" class="label-input100">Umur</label>
                        <input class="form-control" type="number" id="umur" name="umur"
                            placeholder="Masukkan Umur" min="0"name="umur" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="umur" class="label-input100">Role</label>
                        <select class="form-control mb-3" name="role" id="role">
                            <option value="">--PILIH--</option>
                            <option value="user">USER</option>
                            <option value="guru">GURU</option>
                            <option value="admin">ADMIN</option>
                        </select>
                    </div>

                    <div class="form-group collapse" id="select-guru">
                        <label for="umur" class="label-input100">Guru</label>
                        <select class="form-control mb-3" name="guru" id="guru">
                            @forelse ($guru as $gu)
                                <option value="{{ $gu->id }}">{{ $gu->name }}</option>

                            @empty
                                <option value="">-PILIH-</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group collapse" id="select-siswa">
                        <label for="umur" class="label-input100">Siswa</label>
                        <select class="form-control mb-3" name="siswa" id="siswa">
                            @forelse ($siswa as $si)
                                <option value="{{ $si->id }}">{{ $si->name }}</option>

                            @empty
                                <option value="">-PILIH-</option>
                            @endforelse
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <a href="/usercontrol" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $('#role').on('change', function(params) {
                var role = $('#role').val();
                if (role != "") {

                    $('#select-siswa').addClass('collapse')
                    $('#select-guru').addClass('collapse')
                    switch (role) {
                        case 'user':
                            $('#select-siswa').removeClass('collapse')
                            $('#select-guru').addClass('collapse')
                            break;
                        case 'guru':
                            $('#select-siswa').addClass('collapse')
                            $('#select-guru').removeClass('collapse')
                            break;
                        default:
                            $('#select-siswa').addClass('collapse')
                            $('#select-guru').addClass('collapse')
                            break;
                    }
                }
            })

        });
    </script>
@endsection
