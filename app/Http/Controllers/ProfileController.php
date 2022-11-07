<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $data = User::where('id', auth()->user()->id)->first();
        return view('profile', [
            'userProfile' => $data
        ]);
    }

    public function update(Request $request)
    {
        // get data user
        $dataUser = User::where('id', $request->id)->first();
        // set rules
        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns',
            'foto' => 'image|file|max:2024'

        ];
        // add rules jika ganti password
        if ($request->password !== null) {
            $rules = [
                'password_lama' => 'required',
                'password' => 'required|min:6|different:password_lama',
            ];
            // cek password lama diinputan dengan didatabase
            if (!Hash::check($request->password_lama, $dataUser->password)) {
                return redirect('/profile')->with('gagal', "password tidak sama");
            }
        }
        // jalankan validasi
        $request->validate($rules);
        // simpan data dalam variabel
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->file('foto')) {
            if ($request->profile_lama) {
                Storage::delete($request->profile_lama);
            }
            $data['foto'] = $request->file('foto')->store('profile-images');
        }
        // jika ganti password tambahkan data password
        if ($request->password !== null) {
            $data['password'] = Hash::make($request->password);
        }
        // query update 
        $update = User::where('id', $request->id)
            ->update($data);
        // cek jika update berhasil
        if ($update) {
            return redirect('/profile')->with('success', "Profile berhasil diperbaruhi");
        } else {
            return redirect('/profile')->with('gagal', "Data Gagal diperbarui");
        }
    }

    // update profile image
    public function updateImageProfile(Request $request)
    {
        // set rules
        $validate = $request->validate([
            'id_user' => 'required',
            'imageProfile' => 'image|file|max:2024'
        ]);
        if ($request->profile_lama) {
            Storage::delete($request->profile_lama);
        }

        $update = User::where('id', $request->id_user)
            ->update([
                'foto' => $request->file('imageProfile')->store('profile-images')
            ]);
        if ($update) {
            return redirect('/profile')->with('success', "Profile berhasil diperbaruhi");
        } else {
            return redirect('/updateProfileImage')->withErrors($validate);
        }
    }
}
