<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        return UserModel::all();
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|string|unique:m_user,username',
        'nama' => 'required|string',
        'password' => 'required|string|confirmed', // tambah confirmed
        'level_id' => 'required|exists:m_level,level_id',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Upload gambar jika ada
    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('users', 'public');
    }

    // Hash password
    $validated['password'] = bcrypt($validated['password']);

    $user = UserModel::create($validated);

    return response()->json($user, 201);
}

    public function show(UserModel $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, UserModel $user)
    {
        $validated = $request->validate([
            'username' => 'sometimes|string|unique:m_user,username,' . $user->user_id . ',user_id',
            'nama' => 'sometimes|string',
            'password' => 'sometimes|string',
            'level_id' => 'sometimes|exists:m_level,level_id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload file baru jika ada, hapus yang lama
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $validated['foto'] = $request->file('foto')->store('users', 'public');
        }

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    public function destroy(UserModel $user)
    {
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Terhapus',
        ]);
    }
}
