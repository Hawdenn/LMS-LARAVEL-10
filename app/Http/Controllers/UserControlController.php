<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\DataMahasiswa;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserControlController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('user_control.index', ['uc' => $data]);
    }

    public function tambah()
    {
        $siswa = DataMahasiswa::all();
        $guru = Guru::all();
        return view('user_control.tambah', compact('siswa', 'guru'));
    }
    public function create(Request $request)
    {
        $str = Str::random(100);
        $gambar = '';
        $request->validate([
            'fullname' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required',
        ], [
            'fullname.required' => 'Full Name Wajib Di isi',
            'fullname.min' => 'Bidang Full Name minimal harus 4 karakter.',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Invalid',
            'password.required' => 'Password Wajib Di isi',
            'password.min' => 'Password minimal harus 6 karakter.',
            'role.required' => 'Role Wajib Di isi',
        ]);

        if ($request->hasFile('gambar')) {

            $request->validate(['gambar' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('picture/accounts'), $nama_foto);
            $gambar = $nama_foto;
        } else {
            $gambar = "user.jpeg";
        }
        if ($request->role == 'user' && $request->siswa == '') {
            Session::flash('error', 'User blom dipilih.');

            return back();
        }
        if ($request->role == 'guru' && $request->guru == '') {
            Session::flash('error', 'Guru blom dipilih.');

            return back();
        }
        $accounts = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'alamat' => $request->alamat,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'verify_key' => $str,
            'gambar' => $gambar,
            'role' => $request->role,
            'siswa_id' => $request->siswa ?? null,
            'guru_id' => $request->guru ?? null,
        ]);

        $details = [
            'nama' => $accounts->fullname,
            'role' => $request->role,
            'datetime' => date('Y-m-d H:i:s'),
            'website' => 'Laravel10 - Pendaftaran melalui SMTP + Multiuser + CRUD + Sweetalert',
            'url' => 'http://' . request()->getHttpHost() . "/" . "verify/" . $accounts->verify_key,
        ];

        Mail::to($request->email)->send(new AuthMail($details));

        Session::flash('success', 'User berhasil ditambahkan , Harap verifikasi akun sebelum di gunakan.');

        return redirect('/usercontrol');
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->get();
        return view('user_control.edit', ['uc' => $data]);
    }
    public function change(Request $request)
    {
        $request->validate([
            'gambar' => 'image|file|max:1024',
            'fullname' => 'required|min:4',
        ], [
            'gambar.image' => 'File Wajib Image',
            'gambar.file' => 'Wajib File',
            'gambar.max' => 'Bidang gambar tidak boleh lebih besar dari 1024 kilobyte',
            'fullname.required' => 'Nama Wajib Di isi',
            'fullname.min' => 'Bidang nama minimal harus 4 karakter.',
        ]);

        $user = User::find($request->id);

        if ($request->hasFile('gambar')) {
            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('gambar'), $nama_foto);
            $user->gambar = $nama_foto;
        }

        $user->fullname = $request->fullname;
        $user->password = $request->password;
        $user->save();

        Session::flash('success', 'User berhasil diedit');

        return redirect('/usercontrol');
    }
    public function hapus(Request $request)
    {
        User::where('id', $request->id)->delete();

        Session::flash('success', 'Data berhasil dihapus');

        return redirect('/usercontrol');
    }
}
