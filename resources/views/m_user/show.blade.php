@extends('m_user.template')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Detail User</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('m_user.index') }}">Kembali</a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="form-group">
                <strong>User ID:</strong> {{ $useri->user_id }}
            </div>
            <div class="form-group">
                <strong>Level ID:</strong> {{ $useri->level_id }}
            </div>
            <div class="form-group">
                <strong>Username:</strong> {{ $useri->username }}
            </div>
            <div class="form-group">
                <strong>Nama:</strong> {{ $useri->nama }}
            </div>
        </div>
    </div>
</div>
@endsection
