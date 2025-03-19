{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Data User</title>
</head>

<body>
    <h1>Form Tambah Data User</h1>
    <form method="post" action="tambah_simpan">
        {{ csrf_field() }}
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username">
        <br><br>
        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama">
        <br><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan Password">
        <br><br>
        <label>Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan ID Level">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>

</html> --}}
@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Add Data')
{{-- Content body: main page content --}}
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="tambah_simpan">
                {{ csrf_field() }}
                <!-- text input -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                </div>
                <div class="form-group">
                    <label>Level ID</label>
                    <input type="number" class="form-control" name="level_id" placeholder="Masukkan ID Level">
                </div>
                <div class="card-footer">
                    <a href="../user" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Add Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection