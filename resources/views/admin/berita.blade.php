@extends ('admin.layouts.app')

@section('berita')
<h1 class="h3 mb-2 text-gray-800">Tables Berita</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <!-- Tombol Tambah -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahBerita">
            Tambah Berita
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
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Upload</th>
                        <th>Gambar</th>
                        <th>Isi Berita</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($berita as $brta )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-wrap" style="max-width: 200px;">{{$brta->judul}}</td>
                        <td>{{$brta->kategori}}</td>
                        <td>{{$brta->status}}</td>
                        <td>{{$brta->created_at}}</td>
                        <td>
                            <a href="{{ asset('storage/assets/image/berita/' . $brta->gambar) }}" class="glightbox">
                                <img src="{{ asset('storage/assets/image/berita/' . $brta->gambar) }}" class="img-fluid rounded" style="width: 85px;" alt="Bukti Pengaduan" />
                            </a>
                        </td>
                        <td class="text-wrap" style="max-width: 200px;">
                            <span class="short-text">{{ Str::limit($brta->isi_berita, 150) }}</span>
                            <span class="full-text" style="display:none;">{{ $brta->isi_berita }}</span>
                            <a href="javascript:void(0);" class="learn-more" data-toggle="modal" data-target="#textModal{{ $brta->id }}">Learn More</a>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <!-- Tombol Edit -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditBerita{{ $brta->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            
                                <!-- Tombol Hapus -->
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusBerita{{ $brta->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                        
                    </tr>
                    <!-- Modal Edit Berita -->
                    <div class="modal fade" id="modalEditBerita{{ $brta->id }}" tabindex="-1" role="dialog" aria-labelledby="editBeritaLabel{{ $brta->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.berita.update', $brta->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Berita</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="judul">Judul</label>
                                                    <input type="text" class="form-control" name="judul" id="judul" value="{{$brta->judul}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategori">Kategori</label>
                                                    <input type="text" class="form-control" name="kategori" id="kategori" value="{{$brta->kategori}}">
                                                </div>
                                            </div>
                    
                                            <!-- Kolom Kanan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option selected disabled>-Pilih-</option>
                                                        @foreach (['Draf', 'Publish', 'Arsip'] as $status)
                                                            <option value="{{ $status }}" {{ $brta->status == $status ? 'selected' : '' }}>{{ $status }}</option>
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
                                                    @if ($brta->gambar)
                                                        <div class="mb-3 mt-2 text-center">
                                                            <img src="{{ asset('storage/assets/image/berita/' . $brta->gambar) }}" alt="Gambar"  width="150" class="rounded">
                                                        </div>
                                                    @endif
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="isi_berita">Isi Berita</label>
                                                    <textarea class="form-control" name="isi_berita" id="isi_berita" rows="6">{{$brta->isi_berita}}</textarea>
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

                    <!-- Modal Learn More -->
                    <div class="modal fade" id="textModal{{ $brta->id }}" tabindex="-1" role="dialog" aria-labelledby="textModalLabel{{ $brta->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="textModalLabel{{ $brta->id }}">Full Text</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                    <div class="text-black">
                                        {!! nl2br(e($brta->isi_berita)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus Berita -->
                    <div class="modal fade" id="modalHapusBerita{{ $brta->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusBeritaLabel{{ $brta->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.berita.delete', $brta->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus Berita <strong>{{ $brta->judul }}</strong>?</p>
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
<div class="modal fade" id="modalTambahBerita" tabindex="-1" role="dialog" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> <!-- Hapus modal-lg agar ukuran normal -->
        <form action="{{ route('admin.berita.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" name="judul" id="judul" required>
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
                                    <option value="Arsip">Arsip</option>
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
                                <label for="isi_berita">Isi Berita</label>
                                <textarea class="form-control" name="isi_berita" id="isi_berita" rows="6" required></textarea>
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
document.getElementById("modalEditBerita").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});

</script>
@endsection