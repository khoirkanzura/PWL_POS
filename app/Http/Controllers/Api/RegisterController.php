<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'username' => 'required',
        'nama' => 'required',
        'password' => 'required|min:5|confirmed',
        'level_id' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Upload image
    $image = $request->file('image');
    $image->storeAs('public/users', $image->hashName());

    // Buat user baru
    $user = UserModel::create([
        'username' => $request->username,
        'nama' => $request->nama,
        'password' => bcrypt($request->password),
        'level_id' => $request->level_id,
        'image' => $image->hashName(),
    ]);

    // Return response JSON
    if ($user) {
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);
    } else {
        return response()->json([
            'message' => 'User creation failed',
        ], 409);
    }
}
}