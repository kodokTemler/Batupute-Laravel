@extends ('admin.layouts.app')
@section('galeri')
<h1 class="h3 mb-2 text-gray-800">Tables Galeri</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <!-- Tombol Tambah -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahGaleri">
            Tambah Galeri
        </button>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Upload</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galeri as $glri )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-wrap" style="max-width: 200px;">{{$glri->title}}</td>
                        <td>{{$glri->kategori}}</td>
                        <td>{{$glri->status}}</td>
                        <td>{{$glri->created_at}}</td>
                        <td>
                            <a href="{{ asset('storage/assets/image/galeri/' . $glri->gambar) }}" class="glightbox">
                                <img src="{{ asset('storage/assets/image/galeri/' . $glri->gambar) }}" class="img-fluid rounded" style="width: 85px;" alt="Geleri" />
                            </a>
                        </td>
                        <td class="text-wrap" style="max-width: 200px;">
                            <span class="short-text">{{ Str::limit($glri->deskripsi, 150) }}</span>
                            <span class="full-text" style="display:none;">{{ $glri->deskripsi }}</span>
                            <a href="javascript:void(0);" class="learn-more" data-toggle="modal" data-target="#textModal{{ $glri->id }}">Learn More</a>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <!-- Tombol Edit -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditGaleri{{ $glri->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            
                                <!-- Tombol Hapus -->
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusGaleri{{ $glri->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                        
                    </tr>
                    

                    <!-- Modal Learn More -->
                    <div class="modal fade" id="textModal{{ $glri->id }}" tabindex="-1" role="dialog" aria-labelledby="textModalLabel{{ $glri->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="textModalLabel{{ $glri->id }}">Full Text</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                    <div class="text-black">
                                        {!! nl2br(e($glri->deskripsi)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Galeri -->
                    <div class="modal fade" id="modalEditGaleri{{ $glri->id }}" tabindex="-1" role="dialog" aria-labelledby="editGaleriLabel{{ $glri->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.galeri.update', $glri->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Galeri</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title" value="{{$glri->title}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategori">Kategori</label>
                                                    <input type="text" class="form-control" name="kategori" id="kategori" value="{{$glri->kategori}}">
                                                </div>
                                            </div>
                    
                                            <!-- Kolom Kanan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option selected disabled>-Pilih-</option>
                                                        @foreach (['Draf', 'Publish'] as $status)
                                                            <option value="{{ $status }}" {{ $glri->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gambar">Gambar</label>
                                                    <input type="file" class="form-control foto-input" name="gambar" id="gambar">
                                                    <small class="error-message" style="color: red; display: none;"></small>
                                                </div>
                                            </div>
                    
                                            <!-- Alamat - Full Width -->
                                            <div class="col-12">
                                                    @if ($glri->gambar)
                                                        <div class="mb-3 mt-2 text-center">
                                                            <img src="{{ asset('storage/assets/image/galeri/' . $glri->gambar) }}" alt="Gambar"  width="150" class="rounded">
                                                        </div>
                                                    @endif
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi</label>
                                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6">{{$glri->deskripsi}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Hapus Galeri -->
                    <div class="modal fade" id="modalHapusGaleri{{ $glri->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusGaleriLabel{{ $glri->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.galeri.delete', $glri->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus Galeri <strong>{{ $glri->title }}</strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Berita -->
<div class="modal fade" id="modalTambahGaleri" tabindex="-1" role="dialog" aria-labelledby="modalTambahGaleriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> <!-- Hapus modal-lg agar ukuran normal -->
        <form action="{{ route('admin.galeri.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input type="text" class="form-control" name="kategori" id="kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option selected disabled>-Pilih-</option>
                                    <option value="Draf">Draf</option>
                                    <option value="Publish">Publish</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control foto-input" name="gambar" id="gambar" required>
                                <small class="error-message" style="color: red; display: none;"></small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelectorAll(".foto-input").forEach(function(input) {
    input.addEventListener("change", function() {
        const file = this.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        const errorMessage = this.closest(".form-group").querySelector(".error-message");

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                errorMessage.textContent = "Format gambar tidak sesuai! (Hanya jpeg, jpg, png, gif)";
                errorMessage.style.display = "block";
                this.value = ""; // Reset input file
            } else if (file.size > maxSize) {
                errorMessage.textContent = "Ukuran gambar melebihi 5MB!";
                errorMessage.style.display = "block";
                this.value = ""; // Reset input file
            } else {
                errorMessage.style.display = "none";
            }
        }
    });
});

// Reset error saat modal ditutup (gantilah #modalEditKaryawan dengan ID modal-mu)
document.getElementById("modalEditGaleri").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});
</script>
@endsection


                    