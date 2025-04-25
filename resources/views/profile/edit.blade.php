@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-edit fa-2x me-3"></i>
                        <h3 class="mb-0">Edit Profil Saya</h3>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Notifikasi sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #e8f5e9; border-left: 5px solid #2e7d32;">
                            <i class="fas fa-check-circle fa-lg me-3" style="color: #2e7d32;"></i>
                            <div>
                                <h5 class="alert-heading mb-1" style="font-weight: 700; color: #1b5e20;">Berhasil!</h5>
                                <p class="mb-0" style="font-weight: 600; color: #2e7d32;">{{ session('success') }}</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Notifikasi gagal --}}
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #ffebee; border-left: 5px solid #c62828;">
                            <i class="fas fa-exclamation-circle fa-lg me-3" style="color: #c62828;"></i>
                            <div>
                                <h5 class="alert-heading mb-1" style="font-weight: 700; color: #b71c1c;">GAGAL!</h5>
                                <p class="mb-0" style="font-weight: 600; color: #c62828;">{{ session('error') }}</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Menampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                                <div>
                                    <h5 class="alert-heading mb-2">Terjadi kesalahan:</h5>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-5">
                            <div class="avatar-upload mx-auto">
                                <div class="avatar-edit">
                                    <input type="file" name="foto" id="foto" accept="image/*" class="d-none">
                                    <label for="foto" class="btn btn-primary btn-circle btn-lg shadow">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                                <div class="avatar-preview">
                                    @if ($user->foto)
                                        <div id="profilePhotoPreview" style="background-image: url('{{ asset('storage/uploads/user/' . $user->foto) }}');"></div>
                                    @else
                                        <div id="profilePhotoPreview" class="default-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <small class="text-muted d-block mt-2">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-4">
                            <a href="{{ url('/user') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Card Styles */
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3f51b5 0%, #2196f3 100%);
    }
    
    .avatar-upload {
        position: relative;
        max-width: 180px;
    }
    
    .avatar-edit {
        position: absolute;
        right: 10px;
        bottom: 10px;
        z-index: 1;
    }
    
    .btn-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-preview {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        background: #f8f9fa;
        overflow: hidden;
    }
    
    .avatar-preview > div {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    .default-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e0e0e0 0%, #bdbdbd 100%);
        color: #fff;
        font-size: 80px;
    }
    
    .needs-validation .form-control:focus {
        border-color: #3f51b5;
        box-shadow: 0 0 0 0.25rem rgba(63, 81, 181, 0.25);
    }
    
    .btn-outline-secondary {
        border-color: #dee2e6;
    }
    
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
    }
    
    .alert {
        border-radius: 8px;
        border-left: 5px solid;
    }
    
    .alert-success {
        background-color: rgba(40, 167, 69, 0.1);
        border-color: rgba(40, 167, 69, 0.2);
        border-left-color: #28a745;
    }
    
    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.2);
        border-left-color: #dc3545;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .avatar-upload {
            max-width: 150px;
        }
        
        .avatar-preview {
            width: 150px;
            height: 150px;
        }
        
        .default-avatar {
            font-size: 70px;
        }
    }
</style>

<script>
    // Enhanced Image Preview Function
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.getElementById('profilePhotoPreview');
                preview.style.backgroundImage = `url('${e.target.result}')`;
                preview.innerHTML = '';
                preview.classList.remove('default-avatar');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Add click event to file input when profile is clicked
    document.addEventListener('DOMContentLoaded', function() {
        const avatarPreview = document.querySelector('.avatar-preview');
        const fileInput = document.getElementById('foto');
        
        fileInput.addEventListener('change', function() {
            previewImage(this);
            
            // Validasi ukuran file
            if (this.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB');
                this.value = '';
                return false;
            }
        });
        
        avatarPreview.addEventListener('click', function() {
            fileInput.click();
        });
        
        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>

@endsection