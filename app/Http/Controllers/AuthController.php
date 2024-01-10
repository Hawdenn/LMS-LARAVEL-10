<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {

        return view('Auth/login');

    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
        ]
        );

        // Untuk Menyimpan Info login
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Untuk Mengecek Akun Ada Di DataBase
        if (Auth::attempt($infologin)) {
            if (Auth::user()->email_verified_at != null) {
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin')->with('success', 'Halo King, Anda Berhasil Login');
                } else if (Auth::user()->role === 'user') {
                    return redirect()->route('user')->with('success', 'Anda Berhasil Login sebagai siswa');
                } else if (Auth::user()->role === 'guru') {
                    return redirect()->route('guru')->with('success', 'Anda Berhasil Login sebagai Guru');
                }
            } else {
                Auth::logout();
                return redirect()->route('auth')->withErrors('Akun Anda Belum Aktif. Harap Verifikasi Akun Terlebih Dahulu');
            }
            // dd('user');
        }
        // Jika Akun Tidak Ada
        else {
            return redirect()->route('auth')->withErrors('Email Atau Password Anda Salah');
        }

    }
    public function create()
    {
        return view('Auth/register');
    }
    public function register(Request $request)
    {
        $str = Str::random(100);

        $request->validate([

            'fullname' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'umur' => 'required|numeric|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the allowed image types and size
        ], [
            'fullname.required' => 'Full Name Wajib Di Isi',
            'email.required' => 'Email Wajib Di Isi',
            'email.unique' => 'Email Telah Terdaftar',
            'password.required' => 'Password Wajib Di Isi',
            'password.min' => 'Password Minimal 6 karakter',
            'alamat.required' => 'Alamat Wajib Di Isi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Di Isi',
            'agama.required' => 'Agama Wajib Di Isi',
            'umur.required' => 'Umur Wajib Di Isi',
            'umur.numeric' => 'Umur Harus Berupa Angka',
            'umur.min' => 'Umur Tidak Boleh Kurang dari 0',
            'gambar.required' => 'Gambar Wajib Di Upload',
            'gambar.image' => 'Gambar Yang Di Upload Wajib Berupa Image',
            'gambar.mimes' => 'Gambar Wajib Berupa File dengan format: jpeg, png, jpg, gif, svg',
        ]);
        // Untuk Memproses File Gambar Ke Database
        $gambar_file = $request->file('gambar');
        $gambar_extensi = $gambar_file->extension();
        $nama_gambar = date('ymdhis') . "." . $gambar_extensi;
        $gambar_file->move(public_path('picture/accounts'), $nama_gambar);
        // Untuk Menyimpan Ke data register
        $inforegister = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'alamat' => $request->alamat,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'gambar' => $nama_gambar,
            'verify_key' => $str,
        ];

        User::create($inforegister);

        $details = [
            'nama' => $inforegister['fullname'],
            'role' => 'user',
            'datetime' => date('Y-m-d H:i:s'),
            'website' => ' Test-DataSiswa',
            'url' => 'http://' . request()->getHttpHost() . "/verify/" . urlencode($inforegister['verify_key']),
            'url' => 'http://' . request()->getHttpHost() . "/" . "verify/" . $inforegister['verify_key'],
        ];
// Verify Akun Dengan mail Smtp
        Mail::to($inforegister['email'])->send(new AuthMail($details));

        return redirect()->route('auth')->with('success', 'Link Verifikasi Telah Dikirim Ke Email Anda.');
    }

    public function verify($verify_key)
    {
        $keyCheck = User::where('verify_key', $verify_key)->exists();

        if ($keyCheck) {
            User::where('verify_key', $verify_key)->update(['email_verified_at' => now()]);
            return redirect()->route('auth')->with('success', 'Verifikasi Berhasil Akun Anda Sudah Aktif.');
        } else {
            return redirect()->route('auth')->withErrors('Keys Tidak Valid. Pastikan Telah Melakukan Register')->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

   

}
