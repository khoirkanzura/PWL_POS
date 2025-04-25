@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Supplier yang tersedia dalam sistem</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('kategori/import') }}')" class="btn btn-sm btn-info mt-1">Import Data</button>
                <a href="{{ url('/kategori/export_excel') }}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Kategori</a>
                <a href="{{ url('/kategori/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Kategori PDF</a>
                <button onclick="modalAction('{{ url('kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        
                   
                        <!-- Dropdown filter berdasarkan kode supplier -->
                        <div class="col-3">
                            <select class="form-control" id="supplier_kode">
                                <option value="">- Semua Kode -</option>
                            </select>
                            <small class="form-text text-muted">Kode Supplier</small>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode supplier</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    </div>
@endsection

@push('js')
<script>
    function modalAction(url = ''){
        $('#myModal').load(url, function(){
            $('#myModal').modal('show');
        });
    }

    var dataSupplier;
    $(document).ready(function() {
        dataSupplier = $('#table_supplier').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('supplier/list') }}",
                "dataType": "json",
                "type": "POST"
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "supplier_kode", orderable: true, searchable: true },
                { data: "supplier_nama", orderable: true, searchable: true },
                { data: "supplier_telp", orderable: true, searchable: true },
                { data: "supplier_alamat", orderable: false, searchable: false },
                { data: "aksi", orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
