<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserModel;

class ProfileController extends Controller
{
    // Menangani route: GET /profile/
    public function index()
    {
        return redirect()->route('profile.edit');
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', [
            'user' => $user,
            'activeMenu' => 'profile',
            'breadcrumb' => (object)[
                'title' => 'Profil Saya',
                'list' => [
                    route('dashboard'),
                    'Profil'
                ]
            ]
        ]);
    }

    // Memperbarui foto profil
    public function update(Request $request)
    {
        /** @var \App\Models\UserModel $user */
        $user = Auth::user();

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/uploads/user/' . $user->foto)) {
                Storage::delete('public/uploads/user/' . $user->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/user', $filename);

            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Foto profil berhasil diperbarui.');
    }
}
