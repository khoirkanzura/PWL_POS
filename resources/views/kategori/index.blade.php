@extends('layout.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Manage Kategori</span>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
            <a href="{{ url('/kategori/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add
            </a>
        </div>
    </div>
</div>
@endsection

@push('js')
    {{ $dataTable->scripts() }}
@endpush