<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GuruController extends Controller
{
   public function index(){
        return view('pointakses.guru.index');
    }

    public function listKursus($guru_id){
        $user = User::where('guru_id',$guru_id)->first();

            # code...
            $materi = DB::table('courses')
                ->where('courses.user_id',$user->id ?? '0')
                ->paginate(6);
        return view('kursussiswa.listkursus',compact('materi'));

    }

    public function indexGuru(){
        $data = Guru::all();
        return view('data_guru.index', ['data' => $data]);
    }

    public function tambah(){
        return view('data_guru.tambah');
    }

    function edit($id){
        $data = Guru::find($id);
        return view('data_guru.edit',['data' => $data]);
    }
    function hapus (Request $request ){
        Guru::where('id', $request->id)->delete();
        Session::flash('success', 'Berhasil Mengahpus Data');
        return redirect('/dataguru');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'nip' => 'required',
            'alamat' => 'required',
        ], [
            'name.required' => 'Name Wajib Di isi',
            'name.min' => 'Bidang name minimal harus 3 karakter.',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Invalid',
            'nip.required' => 'Nip Wajib Di isi',
            'alamat.required' => 'ALamat Wajib Di isi',

        ]);

        // dd($request->all());
        Guru::insert([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/dataguru')->with('success', 'Berhasil Menambahkan Data');
    }

    function change(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'nip' => 'required',
            'alamat' => 'required',
        ], [
            'name.required' => 'Name Wajib Di isi',
            'name.min' => 'Bidang name minimal harus 3 karakter.',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Invalid',
            'nip.required' => 'Nip Wajib Di isi',
            'alamat.required' => 'Alamat Wajib Di isi',
        ]);

        $dataguru = Guru::find($request->id);

        $dataguru->name = $request->name;
        $dataguru->email = $request->email;
        $dataguru->nip = $request->nip;
        $dataguru->alamat = $request->alamat;
        $dataguru->save();

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/dataguru');
    }
}
