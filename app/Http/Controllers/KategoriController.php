<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        // dd($dataTable);
        return $dataTable->render('kategori.index');
    }
    public function create()
    {
        return view('kategori.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        // Validasi data yang diterima dari form
        $validated = $request->validated();

        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        // The post is valid...

        // Buat data kategori baru berdasarkan input dari form
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        // Redirect ke halaman kategori setelah berhasil menyimpan data
        return redirect('/kategori');
    }
    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $kategori]);
    }
    public function update($id, Request $request)
    {
        $kategori = KategoriModel::find($id);
        $kategori->kategori_kode = $request->kodeKategori;
        $kategori->kategori_nama = $request->namaKategori;
        $kategori->save();
        return redirect('/kategori');
    }
    public function delete($id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();
        return redirect('/kategori');
    }
}
// namespace App\Http\Controllers;

// use App\Models\KategoriModel;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;
// use App\DataTables\KategoriDataTable;
// use Illuminate\Http\RedirectResponse;
// use Yajra\DataTables\Facades\DataTables;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Route;

// class KategoriController extends Controller
// {
//     public function index(KategoriDataTable $dataTable)
//     {
//         return $dataTable->render('kategori.index');
//     }

//     public function create()
//     {
//         return view('kategori.create');
//     }
//     public function store(Request $request): RedirectResponse
//     {
//         $validated = $request->validate([
//             'kodeKategori' => 'required',
//             'namaKategori' => 'required',
//         ]);

//         // $validatedData = $request->validate([
//         //     'kodeKategori' => 'required', 'unique:post', 'max:255',
//         //     'namaKategori' => 'required',
//         // ]);

//         // $validatedData = $request->validateWithBag('post',[
//         //     'kodeKategori' => 'required' 'unique:post', 'max:255',
//         //     'namaKategori' => 'required',
//         // ]);

//         $request->validate([
//             'kodeKategori' => 'bail|required|unique:post|max:255',
//             'namaKategori' => 'required',
//         ]);

//         KategoriModel::create([
//             'kategori_kode' => $request->kodekategori,
//             'kategori_nama' => $request->namaKategori,
//         ]);

//         return redirect('/kategori');
//     }
    

//     public function edit($id)
//     {
//         $kategori = KategoriModel::findOrFail($id);
//         return view('kategori.edit', compact('kategori'));
//     }
//     public function update(Request $request, $id)
//     {
//         $kategori = KategoriModel::findOrFail($id);
//         $kategori->update([
//             'kategori_kode' => $request->kodeKategori,
//             'kategori_nama' => $request->namaKategori,
//         ]);

//         return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
//     }
//     public function dataTableAction($kategori)
//     {
//          return '<a href="'.route('kategori.edit', $kategori->id).'" class="btn btn-sm btn-warning">Edit</a>';
//     }
//      public function destroy($id)
//      {
//          try {
//              $kategori = KategoriModel::findOrFail($id); // Pastikan kategori ditemukan
     
//              $kategori->delete();
//              return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
//          } catch (\Exception $e) {
//              Log::error('Error deleting kategori: ' . $e->getMessage());
//              return redirect()->route('kategori.index')->with('error', 'Terjadi kesalahan saat menghapus kategori');
//          }
//      }
// }

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\DataTables\KategoriDataTable;

// class KategoriController extends Controller
// {
//     public function index(KategoriDataTable $dataTable)
//     {
//         return $dataTable->render('kategori.index');
//     }
// }


    
       /* $data = [
            'kategori_kode' => 'SNK',
            'kategori_nama' => 'Snack/Makanan Ringan',
            'created_at' => now()
        ];

        DB::table('m_kategori')->insert($data);
        return 'Insert data baru berhasil'; */

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // $data = DB::table('m_kategori') ->get();
        // return view('kategori', ['data' => $data]);

    

