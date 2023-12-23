<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
   public function index(){
        return view('pointakses.guru.index');
    }

    public function listKursus($guru_id){
        $materi = Courses::paginate(8);
        return view('kursussiswa.listkursus',compact('materi'));

    }

    public function indexGuru(){
        $data = Guru::all();
        return view('data_guru.index', ['data' => $data]);
    }

    public function tambah(){
        return view('data_guru.tambah');
    }
}
