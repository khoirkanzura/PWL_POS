@extends('layout.app')

 @section('subtitle', 'Kategori')
 @section('header_title', 'Kategori')
 @section('header_subtitle', 'Edit')
 
 @section('content')
 <div class="container">
     <div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">Edit Kategori</h3>
         </div>
         {{-- <form method="POST" action="kategori.edit{{ $kategori->kategori_id }}"> --}}
         <form method="POST" action="{{ route('kategori.edit', $kategori->kategori_id) }}">
             @csrf
             @method('PUT') 
             <div class="card-body">
                 <div class="form-group">
                     <label for="kodeKategori">Kode Kategori</label>
                     <input type="text" name="kodeKategori" id="kodeKategori" value="{{ old('kodeKategori', $kategori->kategori_kode) }}" class="form-control" required>
                 </div>
                 <div class="form-group">
                     <label for="namaKategori">Nama Kategori</label>
                     <input type="text" name="namaKategori" id="namaKategori" value="{{ old('namaKategori', $kategori->kategori_nama) }}" class="form-control" required>
                 </div>
             </div>
             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">Update</button>
                 <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
             </div>
         </form>
     </div>
 </div>
 @endsection