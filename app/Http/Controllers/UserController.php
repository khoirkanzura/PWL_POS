<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $user = UserModel::with('level')->get(); // Mengambil semua data dari tabel users
        return view('user', ['data' => $user]);

        // $user = UserModel::with('level')->get(); // Mengambil semua data dari tabel users
        // dd($user);
        // $user = UserModel::all(); // Mengambil semua data dari tabel users
        // return view('user', ['data' => $user]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        // Simpan data ke database
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    

        public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
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

               
            
        
        

        
    

