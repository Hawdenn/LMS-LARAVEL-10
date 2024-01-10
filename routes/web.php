<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UproleController;
use App\Http\Controllers\UserControlController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('Auth.login');
});

Route::middleware(['guest'])->group(function () {
    // Untuk Login //
    Route::get('sesi', [AuthController::class, 'index'])->name('auth');
    Route::post('/sesi', [AuthController::class, 'login']);

    // Untuk Daftar //
    Route::get('reg', [AuthController::class, 'create'])->name('registrasi');
    Route::post('/reg', [AuthController::class, 'register']);

    // Untuk Melakukan Verifikasi
    // Route::get('/verify/{verify_key }',[AuthController::class,'verify']);
    Route::get('/verify/{verify_key}', [AuthController::class, 'verify']);
});

// Untuk Route Admin,guru Dan User
Route::middleware(['auth'])->group(function () {
    Route::redirect('/home', '/user');
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin')
        ->middleware('userAkses:admin');
    Route::get('/user', [UserController::class, 'index'])
        ->name('user')
        ->middleware('userAkses:user');
    Route::get('/guru', [GuruController::class, 'index'])
        ->name('guru')
        ->middleware('userAkses:guru');

//  Untuk Route profile
    // Route::middleware(['auth'])->group(function () {
    //     // Route untuk menampilkan profil pengguna

    // });

// Route datamahasiswa

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('profile/update', [ProfileController::class, 'change'])->name('profile.change');

    Route::get('/datamahasiswa', [DataMahasiswaController::class, 'index'])->name('datamahasiswa');
    Route::get('/damatambah', [DataMahasiswaController::class, 'tambah']);
    Route::get('/damaedit/{id}', [DataMahasiswaController::class, 'edit']);
    Route::post('/damahapus/{id}', [DataMahasiswaController::class, 'hapus']);
    // new
    Route::post('/tambahdama', [DataMahasiswaController::class, 'create']);
    Route::post('/editdama', [DataMahasiswaController::class, 'change']);

    Route::get('/dataguru', [GuruController::class, 'indexGuru'])->name('dataguru');
    Route::get('/datagurutambah', [GuruController::class, 'tambah']);
    Route::get('/dataguruedit/{id}', [GuruController::class, 'edit']);
    Route::post('/dataguruhapus/{id}', [GuruController::class, 'hapus']);
    Route::post('/tambahdataguru', [GuruController::class, 'create']);
    Route::post('/editdataguru', [GuruController::class, 'change']);

    Route::get('/usercontrol', [UserControlController::class, 'index'])->name('usercontrol');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/tambahuc', [UserControlController::class, 'tambah']);
    Route::get('/edituc/{id}', [UserControlController::class, 'edit']);
    Route::post('/hapusuc/{id}', [UserControlController::class, 'hapus']);
    Route::post('/tambahuc', [UserControlController::class, 'create']);
    Route::post('/edituc', [UserControlController::class, 'change']);

    Route::post('/uprole/{id}', [UproleController::class, 'index']);

//  Untuk Route Mapel
    Route::get('/courses', [CoursesController::class, 'index'])->name('coursesindex');
    Route::get('/coursestambah', [CoursesController::class, 'tambah'])->name('coursestambah');
    Route::post('/coursestambah', [CoursesController::class, 'create']);
    Route::get('/editcourses/{id}', [CoursesController::class, 'edit']);
    Route::post('/editcourses', [CoursesController::class, 'change']);
    Route::post('/courseshapus/{id}', [CoursesController::class, 'hapus']);

    // Route::get('/edituc/{id}', [CoursesController::class, 'edit']);
    // Route::post('/hapusuc/{id}', [CoursesController::class, 'hapus']);
    // Route::post('/tambahuc', [CoursesController::class, '']);
    // Route::post('/edituc', [CoursesController::class, 'change']);

    Route::get('/kursuslist', [KursusController::class, 'index'])->name('kursuslist');

    Route::get('/profileguru/{id}', [GuruController::class, 'index'])->name('profileguru');

    Route::get('/kursuslistguru/{id}', [GuruController::class, 'listKursus'])->name('kursuslistguru');

    Route::get('/courses-show-pdf/{id}', [KursusController::class, 'show'])->name('courses-show-pdf');
    Route::get('/courses-show-video/{id}', [KursusController::class, 'showVideo'])->name('courses-show-video');

});
