<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }
    public function create()
    {
        return view('kategori.create');
    }
   
    public function store(StorePostRequest $request): RedirectResponse
    {
        // Retrive the validated input data...
        $validatedData = $request->validated();

        // Retrive a portion of the validated input data
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        // B. Validasi pada server
        //$validatedData = $request->validate([

            // 'kategori_kode' => ['required', 'unique:m_kategori', 'max:10'],
            // 'kategori_nama' => ['required'],
        //     'kategori_kode' => 'bail|required|unique:m_kategori|max:10',
        //     'kategori_nama' => 'bail|required|unique:m_kategori',
        // ]);

        // KategoriModel::create([
            // 'kategori_kode' => $request->kategori_kode,
            // 'kategori_nama' => $request->kategori_nama,
        //]);

        return redirect('/kategori');
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $kategori]);
    }
    public function edit_save($id, Request $request)
    {
        $kategori = KategoriModel::find($id);

        $kategori->kategori_kode = $request->kodeKategori;
        $kategori->kategori_nama = $request->namaKategori;

        $kategori->save();

        return redirect('/kategori');
    }
    public function deleteKtg($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        $kategori->delete();
        return redirect('/kategori');
    }
}

// namespace App\Http\Controllers;

// use App\Models\LevelModel;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class LevelController extends Controller
// {
//     public function index()
//     {
//         // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', 
//         //            ['CUS', 'Pelanggan', now()]);
//         // return 'Insert data baru berhasil';

//         // $row = DB::update('Update m_level set level_nama = ? where level_kode = ?',
//         //                    ['Customer', 'CUS']);
//         // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

//         // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
//         // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row. ' baris';

//         // $data = DB::select('select * from m_level');
//         // return view('level', ['data' => $data]);
//         // $data = DB::select('select * from m_level');
//         // return view('level', ['data' => $data]);

//         $data = DB::select('select * from m_level');
//         return view('level', ['data' => $data]);
//     }
//     public function tambah()
//     {
//         return view('level_tambah');
//     }
//     public function tambah_simpan(Request $request)
//     {
//         LevelModel::create([
//             'level_kode' => $request->level_kode,
//             'level_nama' => $request->level_nama,
//         ]);
//         // return redirect('/level');
//         return redirect()->route('level.tambah');

//         // Retrieve a portion of the validated input data
//         // $validated = $request->safe()->only(['level_kode', 'level_nama']);
//         // $validated = $request->safe()->except(['level_kode', 'level_nama']);
//     }
// }

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class LevelController extends Controller
// {
//     public function index()
//     {
//         // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]);
//         // return 'insert data baru berhasil';

//         // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['customer', 'CUS']);
//         // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.'baris';

//         //  $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
//         //  return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row.'baris';

//         DB::insert('INSERT INTO m_level (level_id, level_kode, level_nama, created_at) VALUES (?, ?, ?, ?)', 
//         [4, 'CUS', 'Pelanggan', now()]);
    
//         $data = DB::select('select * from m_level');
//         return view('level', ['data' => $data]);
//     }
// }
