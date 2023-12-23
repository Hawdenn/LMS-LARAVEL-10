<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KursusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $materi = MateriFile::getDataByPegawai($pegawai->pegawai_id);
        $guru = DB::table('guru')
            ->where([
                ['guru.name', '!=', Null],
                [function ($query) use ($request) {
                    if (($s = $request->s)) {
                        $query->orWhere('guru.name', 'LIKE', '%' . $s . '%')
                            ->orWhere('guru.alamat', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }]
            ])
            ->paginate(1);


        // dd($count);

        $data['guru'] = $guru;
        $data['search'] = $request->s;
        return view('kursussiswa.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $file = Courses::where('id', '=', $id)->first();
        return view('kursussiswa.pdfview', ['data' => $file]);
    }
    public function showVideo($id)
    {
        $file = Courses::where('id', '=', $id)->first();
        return view('kursussiswa.videoview', ['data' => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
