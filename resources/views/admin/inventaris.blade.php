@extends ('admin.layouts.app')

@section('inventaris')
<h1 class="h3 mb-2 text-gray-800">Tables Inventaris</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        <!-- Tombol Tambah -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahInventaris">
            Tambah Inventaris
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
                        <th>Foto</th>
                        <th>Nama Brg</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Thn Pengadaan</th>
                        <th>Sumber Dana</th>
                        <th>Harga Perbarang</th>
                        <th>Lokasi Penyimpanan</th>
                        <th>Keterangan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventaris as $invtr )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ asset('storage/assets/image/inventaris/' . $invtr->foto_barang) }}" class="glightbox">
                                <img src="{{ asset('storage/assets/image/inventaris/' . $invtr->foto_barang) }}" class="img-fluid rounded" style="width: 85px;" alt="Foto Barang" />
                            </a>
                        </td>
                        <td>{{$invtr->nama_barang}}</td>
                        <td>{{$invtr->kategori}}</td>
                        <td>{{$invtr->jumlah}}</td>
                        <td>{{$invtr->kondisi}}</td>
                        <td>{{$invtr->tahun_pengadaan}}</td>
                        <td>{{$invtr->sumber_dana}}</td>
                        <td>Rp. {{ number_format($invtr->harga_per_barang, 0, ',', '.') }}</td>
                        <td>{{$invtr->lokasi_penyimpanan}}</td>
                        <td>{{$invtr->keterangan}}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <!-- Tombol Edit -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditInventaris{{ $invtr->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            
                                <!-- Tombol Hapus -->
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusInventaris{{ $invtr->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                        
                    </tr>
                    <!-- Modal Edit Inventaris -->
                    <div class="modal fade" id="modalEditInventaris{{ $invtr->id }}" tabindex="-1" role="dialog" aria-labelledby="editInventarisLabel{{ $invtr->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.inventaris.update', $invtr->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Inventaris</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_barang">Nama Barang</label>
                                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="{{$invtr->nama_barang}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategori">Kategori</label>
                                                    <input type="text" class="form-control" name="kategori" id="kategori" value="{{$invtr->kategori}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{$invtr->jumlah}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kondisi">Kondisi</label>
                                                    <select name="kondisi" id="kondisi" class="form-control">
                                                        <option selected disabled>-Pilih-</option>
                                                        @foreach (['Baik', 'Rusak'] as $kondisi)
                                                            <option value="{{ $kondisi }}" {{ $invtr->kondisi == $kondisi ? 'selected' : '' }}>{{ $kondisi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                    
                                            <!-- Kolom Kanan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tahun_pengadaan">Tahun Pengadaan</label>
                                                    <input type="number" class="form-control" name="tahun_pengadaan" id="tahun_pengadaan" min="1900" max="2099" step="1" placeholder="YYYY" value="{{$invtr->tahun_pengadaan}}">
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="sumber_dana">Sumber Dana</label>
                                                        <input type="text" class="form-control" name="sumber_dana" id="sumber_dana" value="{{$invtr->sumber_dana}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga_per_barang">Harga Per Barang</label>
                                                    <input type="number" class="form-control" name="harga_per_barang" id="harga_per_barang" min="0" value="{{$invtr->harga_per_barang}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lokasi_penyimpanan">Lokasi Penyimpanan</label>
                                                    <input type="text" class="form-control" name="lokasi_penyimpanan" id="lokasi_penyimmpanan" value="{{$invtr->lokasi_penyimpanan}}">
                                                </div>
                                            </div>
                    
                                            <!-- Alamat - Full Width -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="foto_barang">Foto</label>
                                                    <input type="file" class="form-control foto-input" name="foto_barang" id="foto_barang">
                                                    <small class="error-message" style="color: red; display: none;"></small>
                                                    @if ($invtr->foto_barang)
                                                        <div class="mt-3">
                                                            <img src="{{ asset('storage/assets/image/inventaris/' . $invtr->foto_barang) }}" alt="Foto Inventaris"  width="150" class="rounded">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{$invtr->keterangan}}</textarea>
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

                    <!-- Modal Hapus Inventaris -->
                    <div class="modal fade" id="modalHapusInventaris{{ $invtr->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusInventarisLabel{{ $invtr->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.inventaris.delete', $invtr->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus Inventaris <strong>{{ $invtr->nama_barang }}</strong>?</p>
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

<!-- Modal Tambah Inventaris -->
<div class="modal fade" id="modalTambahInventaris" tabindex="-1" role="dialog" aria-labelledby="modalTambahInventarisLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> <!-- Hapus modal-lg agar ukuran normal -->
        <form action="{{ route('admin.inventaris.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input type="text" class="form-control" name="kategori" id="kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                            </div>
                            <div class="form-group">
                                <label for="kondisi">Kondisi</label>
                                <select name="kondisi" id="kondisi" class="form-control" required>
                                    <option selected disabled>-Pilih-</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_pengadaan">Tahun Pengadaan</label>
                                <input type="number" class="form-control" name="tahun_pengadaan" id="tahun_pengadaan" required min="1900" max="2099" step="1" placeholder="YYYY">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="sumber_dana">Sumber Dana</label>
                                    <input type="text" class="form-control" name="sumber_dana" id="sumber_dana" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="harga_per_barang">Harga Per Barang</label>
                                <input type="number" class="form-control" name="harga_per_barang" id="harga_per_barang" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_penyimpanan">Lokasi Penyimpanan</label>
                                <input type="text" class="form-control" name="lokasi_penyimpanan" id="lokasi_penyimmpanan" required>
                            </div>
                        </div>

                        <!-- Alamat - Full Width -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="foto_barang">Foto</label>
                                <input type="file" class="form-control foto-input" name="foto_barang" id="foto_barang" required>
                                <small class="error-message" style="color: red; display: none;"></small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
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
        const maxSize = 2 * 1024 * 1024; // 2MB
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        const errorMessage = this.closest(".form-group").querySelector(".error-message");

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                errorMessage.textContent = "Format gambar tidak sesuai! (Hanya jpeg, jpg, png, gif)";
                errorMessage.style.display = "block";
                this.value = ""; // Reset input file
            } else if (file.size > maxSize) {
                errorMessage.textContent = "Ukuran gambar melebihi 2MB!";
                errorMessage.style.display = "block";
                this.value = ""; // Reset input file
            } else {
                errorMessage.style.display = "none";
            }
        }
    });
});

// Reset error saat modal ditutup (gantilah #modalEditKaryawan dengan ID modal-mu)
document.getElementById("modalEditInventaris").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});

</script>
@endsection