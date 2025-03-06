<?php

namespace App\Http\Controllers;

// use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
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
        // $user = UserModel::all(); // ambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);

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
       
       
        
        
                $user = UserModel::create([
                    'username' => 'manager55',
                    'nama' => 'Manager55',
                    'password' => Hash::make('12345'),
                    'level_id' => 2
                ]);
                
                $user->username = 'manager56';
                
                // Mengecek perubahan atribut
                $user->isDirty('username'); // true
                $user->isDirty('nama'); // false
                $user->isDirty(['nama', 'username']); // true
                
                $user->isClean('username'); // false
                $user->isClean('nama'); // true
                $user->isClean(['nama', 'username']); // false
                
                $user->save();
                
                $user->isDirty(); // false
                $user->isClean(); // true
                dd($user->isDirty());
            }
        }
        

        
    

