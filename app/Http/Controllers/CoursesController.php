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
        $data = Courses::all(); // Use the correct model class to fetch all records
        // dd($data);
        $course =  Courses::query();
        $course->select('courses.*','u.fullname as pembuat');
        $course->leftJoin('users as u','u.id','courses.user_id');
        $data = $course->get();
        // dd($data);
        return view('courses.index', ['data' => $data]);
    }
    public function tambah(){
        return view('courses.tambah');
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $user  = Auth::user();
            $request->validate([
                'name' => 'required|min:3',
                'title' => 'required',
                'description' => 'required',
            ], [
                'name.required' => 'Name Wajib Di isi',
                'title.required' => 'Tittle Wajib Di isi',
                'description.required' => 'Description Wajib Di isi',
            ]);
            $dir =  public_path('files');

            $course =  new Courses;

            $course->name = $request->name;
            $course->title = $request->title;
            $course->description = $request->description;


            // if (isset($_FILES['photo'])) {
            //    self::simpanFile($dir, $_FILES['photo']);
            // }
            // if (isset($_FILES['file'])) {
            //    self::simpanFile($dir, $_FILES['file']);
            // }
            $course->photo =  'photo';
            $course->file =  'file';
            $course->user_id =  $user->id;

            if (!$course->save()) {
                throw new Exception("Terjadi kesalahan saat menyimpan course");

            }
            DB::commit();
            Session::flash('success', 'Data berhasil ditambahkan');

            return redirect('/courses')->with('success', 'Berhasil Menambahkan Data');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            Session::flash('error',  $th->getMessage());

            return redirect('/courses')->with('error', $th->getMessage());
        }

    }
    function simpanFile($dir, $file)
    {

    }
    public function edit(){
        return view('courses.edit');
    }
    public function show(){
        return view('courses.show');
    }
}
