<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Retrieve the authenticated user

        return view('profile.detail', compact('user'));
    }
    public function edit()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, get user data
            $user = Auth::user();

            return view('profile.edit', compact('user'));
        } else {
            // User is not authenticated, redirect to login or handle as needed
            return redirect()->route('login'); // You can adjust this based on your application logic
        }
    }

    public function change(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:5',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'umur' => 'required|numeric|min:0',
        ], [
            'fullname.required' => 'Full Name Wajib Di Isi',
            'alamat.required' => 'Alamat Wajib Di Isi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Di Isi',
            'agama.required' => 'Agama Wajib Di Isi',
            'umur.required' => 'Umur Wajib Di Isi',
            'umur.numeric' => 'Umur Harus Berupa Angka',
            'umur.min' => 'Umur Tidak Boleh Kurang dari 0',
        ]);

        // Get the user by ID
        $dataprofile = User::find($request->id);

        // Check if the user exists
        if ($dataprofile) {
            // Update user fields
            $dataprofile->fullname = $request->fullname;
            $dataprofile->email = $request->email;
            $dataprofile->password = $request->password; // Make sure you handle password properly
            $dataprofile->alamat = $request->alamat;
            $dataprofile->jenis_kelamin = $request->jenis_kelamin;
            $dataprofile->agama = $request->agama;
            $dataprofile->umur = $request->umur;

            // Save changes
            $dataprofile->save();

            // Display the fullname for debugging
            dd($dataprofile->fullname);

            Session::flash('success', 'Berhasil Mengubah Data');
            return redirect('/profile');
        } else {
            // Handle case where user is not found
            Session::flash('error', 'User not found');
            return redirect('/profile');
        }
    }


}
