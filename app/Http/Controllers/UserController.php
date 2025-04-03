<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = UserModel::all();
        return view('user_index', ['users' => $users]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        // Validasi input dengan aturan ketat
        $request->validate([
            'username' => 'required|alpha_num|unique:m_user,username|min:5|max:20',
            'nama' => 'required|string|min:3|max:50',
            'password' => 'required|string|min:6|max:20',
            'level_id' => 'required|integer|exists:m_user_levels,id'
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.alpha_num' => 'Username hanya boleh mengandung huruf dan angka.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'username.min' => 'Username minimal 5 karakter.',
            'username.max' => 'Username maksimal 20 karakter.',

            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'nama.max' => 'Nama maksimal 50 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password maksimal 20 karakter.',

            'level_id.required' => 'Level ID wajib diisi.',
            'level_id.integer' => 'Level ID harus berupa angka.',
            'level_id.exists' => 'Level ID tidak valid.'
        ]);

        // Simpan data ke database
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'User berhasil ditambahkan!');
    }

    public function ubah($id)
    {
        $user = UserModel::findOrFail($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        // Validasi input saat update
        $request->validate([
            'username' => 'required|alpha_num|unique:m_user,username,' . $id . '|min:5|max:20',
            'nama' => 'required|string|min:3|max:50',
            'password' => 'nullable|string|min:6|max:20',
            'level_id' => 'required|integer|exists:m_user_levels,id'
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.alpha_num' => 'Username hanya boleh mengandung huruf dan angka.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'username.min' => 'Username minimal 5 karakter.',
            'username.max' => 'Username maksimal 20 karakter.',

            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'nama.max' => 'Nama maksimal 50 karakter.',

            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password maksimal 20 karakter.',

            'level_id.required' => 'Level ID wajib diisi.',
            'level_id.integer' => 'Level ID harus berupa angka.',
            'level_id.exists' => 'Level ID tidak valid.'
        ]);

        $user = UserModel::findOrFail($id);

        $data = [
            'username' => $request->username,
            'nama' => $request->nama,
            'level_id' => $request->level_id,
        ];

        // Hanya update password jika diisi
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('/user')->with('success', 'User berhasil diubah!');
    }

    public function hapus($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('success', 'User berhasil dihapus!');
    }
}



 
        // tambah data user dengan Eloquent Model
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')

        //     // 'nama' => 'Pelanggan Pertama'
        //     // 'username' => 'customer-1',
        //     // 'nama' => 'Pelanggan',
        //     // 'password' => Hash::make('12345'),
        //     // 'level_id' => 4
        // ];
        // UserModel::create($data); // tambahkan data ke tabel m_user

        // UserModel::where('username', 'customer-1') ->update($data);
        // UserModel::insert($data);// tambahkan data ke tabel m_user

        // // coba akses model UserModel
        
        // $user = UserModel::find(1); // ambil data user dengan id 1
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstwhere('level_id', 1)->first(); // ambil data user dengan id 1
        // return view('user', ['data' => $user]);
        
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //         abort(404);
        // }); 
        // return view('user', ['data' => $user]);

        // $user = UserModel::findOrFail(1); // ambil data user dengan level_id 1
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 2)->count();
       
       
        
        
                // $user = UserModel::create([
                //     'username' => 'manager11',
                //     'nama' => 'Manager11',
                //     'password' => Hash::make('12345'),
                //     'level_id' => 2
                // ]);
                
                // $user->username = 'manager12';
                // $user->save();

                // // Mengecek perubahan 
                // $user->wasChanged(); // true
                // $user->wasChanged('username'); // true
                // $user->wasChanged(['username', 'level_id']); // true
                // $user->wasChanged('nama'); // false
                // $user->wasChanged(['nama', 'username']); // true
                // dd($user->wasChanged(['nama', 'username']));

               
            
        
        

        
    

