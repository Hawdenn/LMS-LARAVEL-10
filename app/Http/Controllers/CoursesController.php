<?php

namespace App\Http\Controllers;

use App\Models\Courses; // Correct model class name
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CoursesController extends Controller
{
    public function index()
    {
        // dd($data);
        $user = Auth::user();
        $course = Courses::query();
        $course->select('courses.*', 'u.fullname as pembuat');
        $course->leftJoin('users as u', 'u.id', 'courses.user_id');
        if ($user->role != "admin") {
            # code...
            $course->where('courses.user_id', $user->id);
        }
        $data = $course->get();
        // dd($data);
        return view('courses.index', ['data' => $data]);
    }

    public function tambah()
    {
        // Display the form to add a new course
        return view('courses.tambah'); 
    }
    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $request->validate([
                'name' => 'required|min:3',
                'title' => 'required',
                'description' => 'required',
            ], [
                'name.required' => 'Name Wajib Di isi',
                'title.required' => 'Tittle Wajib Di isi',
                'description.required' => 'Description Wajib Di isi',
            ]);
            $dir = public_path('files');

            $course = new Courses;

            $course->name = $request->name;
            $course->title = $request->title;
            $course->description = $request->description;

            if (isset($_FILES['photo'])) {
                $fileptot = self::simpanFile($dir, $_FILES['photo']);
            }
            if (isset($_FILES['file'])) {
                $filepdf = self::simpanFile($dir, $_FILES['file']);
            }

            if ($request->hasFile('photo')) {

                $request->validate(['photo' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

                $gambar_file = $request->file('photo');
                $foto_ekstensi = $gambar_file->extension();
                $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
                $gambar_file->move(public_path('files'), $nama_foto);
                $course->photo = $nama_foto;
            }
            if ($request->hasFile('file')) {

                $request->validate(['file' => 'mimes:pdf,mp4,mkv|file']);

                $gambar_file = $request->file('file');
                $foto_ekstensi = $gambar_file->extension();
                $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
                $gambar_file->move(public_path('files'), $nama_foto);
                $course->file = $nama_foto;
            }
            $course->user_id = $user->id;

            if (!$course->save()) {
                throw new Exception("Terjadi kesalahan saat menyimpan course");

            }
            DB::commit();
            Session::flash('success', 'Data berhasil ditambahkan');

            return redirect('/courses')->with('success', 'Berhasil Menambahkan Data');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            Session::flash('error', $th->getMessage());

            return redirect('/courses')->with('error', $th->getMessage());
        }

    }
    public function simpanFile($dir, $file)
    {

    }
    public function edit($id)
    {
        $data = Courses::find($id);
        return view('courses.edit', ['data' => $data]);
    }
    public function change(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'file' => 'required',
        ], [
            'name.required' => 'Name Wajib Di isi',
            'name.min' => 'Bidang name minimal harus 3 karakter.',
            'title.required' => 'title Wajib Di isi',
            'description.required' => 'description Wajib Di isi',
            'photo.required' => 'photo Wajib Di isi',
            'file.required' => 'file Wajib Di isi',
        ]);
// dd($request->all());
        $datacourses = Courses::find($request->id);

        $datacourses->name = $request->name;
        $datacourses->title = $request->title;
        $datacourses->description = $request->description;
        $datacourses->photo = $request->photo;
        $datacourses->file = $request->file;
        $datacourses->save();

        Session::flash('success', 'Berhasil Mengubah Data Courses');

        return redirect('/courses');
    }
    function hapus (Request $request ){
        Courses::where('id', $request->id)->delete();
        Session::flash('success', 'Berhasil Mengahpus Data Course');
        return redirect('/courses');
    }
    public function show()
    {
        return view('courses.show');
    }



}
