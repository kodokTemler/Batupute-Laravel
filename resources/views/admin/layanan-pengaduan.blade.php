@extends('admin.layouts.app')
@section('pengaduan')
<h1 class="h3 mb-2 text-gray-800">Tables Data Layanan Pengaduan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDataPengaduan">
                                <i class="fas fa-plus"></i>
                                Tambah Data Pengaduan
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
                                            <th>Nama</th>
                                            <th>Nomor Hp</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Foto</th>
                                            <th>Isi Pengaduan</th>
                                            <th>Tanggal Pengaduan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($layananPengaduan as $lapeng )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$lapeng->nama}}</td>
                                            <td>{{$lapeng->nomor_hp}}</td>
                                            <td>{{$lapeng->kategori}}</td>
                                            <td>{{$lapeng->status}}</td>
                                            <td>
                                                <a href="{{ asset('storage/assets/image/layananPengaduan/' . $lapeng->foto_bukti) }}"
                                                class="glightbox">
                                                    <img src="{{ asset('storage/assets/image/layananPengaduan/' . $lapeng->foto_bukti) }}"
                                                        class="img-fluid rounded"
                                                        style="width: 60px;" alt="Bukti Pengaduan" />
                                                </a>
                                            </td>
                                            <td>{!! nl2br(e($lapeng->isi_pengaduan)) !!}</td>
                                            <td>{{ $lapeng->created_at->translatedFormat('d/m/Y') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDataPengaduan{{ $lapeng->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDataPengaduan{{ $lapeng->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditDataPengaduan{{ $lapeng->id }}" tabindex="-1" role="dialog" aria-labelledby="editDataPengaduanLabel{{ $lapeng->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-pengaduan.update', $lapeng->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Pengaduan</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" class="form-control" name="nama" id="nama" value="{{$lapeng->nama}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="kategori">Kategori</label>
                                                                <select name="kategori" id="kategori" class="form-control" >
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Umum', 'Sosial', 'Keamanan', 'Kesehatan', 'Kebersihan'] as $kategori)
                                                                        <option value="{{ $kategori }}" {{ $lapeng->kategori == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        
                                                            <div class="form-group">
                                                                <label for="foto_bukti">Foto</label>
                                                                <input type="file" class="form-control foto-input" name="foto_bukti" id="foto_bukti" >
                                                                <small class="error-message" style="color: red; display: none;"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nomor_hp">Nomor Hp</label>
                                                                <input type="tel" class="form-control" name="nomor_hp" id="nomor_hp" value="{{$lapeng->nomor_hp}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control" >
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Diterima', 'Diproses', 'Selesai'] as $status)
                                                                        <option value="{{ $status }}" {{ $lapeng->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Foto Sebelumnya :</label>
                                                                @if ($lapeng->foto_bukti)
                                                                    <div class="mt-3 text-center">
                                                                        <img src="{{ asset('storage/assets/image/layananPengaduan/' . $lapeng->foto_bukti) }}" alt="Foto Bukti"  width="150" class="rounded">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="isi_pengaduan">Isi Pengaduan</label>
                                                                <textarea class="form-control" name="isi_pengaduan" id="isi_pengaduan" rows="6" >{{$lapeng->isi_pengaduan}}</textarea>
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

                                        <!-- Modal Hapus Admin -->
                                        <div class="modal fade" id="modalHapusDataPengaduan{{ $lapeng->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataPengaduanLabel{{ $lapeng->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-pengaduan.delete', $lapeng->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <p>Yakin ingin menghapus pengaduan ini <strong>{{ $lapeng->nama }}</strong>?</p>
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
                    <!-- Modal Tambah Admin -->
                    <div class="modal fade" id="modalTambahDataPengaduan" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataPengaduanLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.layanan-pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Layanan Pengaduan</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" id="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select name="kategori" id="kategori" class="form-control" required>
                                                <option selected disabled>-Pilih-</option>
                                                <option value="Umum">Umum</option>
                                                <option value="Sosial">Sosial</option>
                                                <option value="Keamanan">Keamanan</option>
                                                <option value="Kesehatan">Kesehatan</option>
                                                <option value="Kebersihan">Kebersihan</option>
                                            </select>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="foto_bukti">Foto</label>
                                            <input type="file" class="form-control foto-input" name="foto_bukti" id="foto_bukti" >
                                            <small class="error-message" style="color: red; display: none;"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nomor_hp">Nomor Hp</label>
                                            <input type="tel" class="form-control" name="nomor_hp" id="nomor_hp" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option selected disabled>-Pilih-</option>
                                                <option value="Diterima">Diterima</option>
                                                <option value="Diproses">Diproses</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="isi_pengaduan">Isi Pengaduan</label>
                                            <textarea class="form-control" name="isi_pengaduan" id="isi_pengaduan" rows="6" required></textarea>
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
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/heic', 'image/heif'];

        const errorMessage = this.closest(".form-group").querySelector(".error-message");

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                errorMessage.textContent = "Format gambar tidak sesuai! (Hanya jpeg, jpg, png, gif, heic, heif)";
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
document.getElementById("modalEditDataPengaduan").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});
</script>
@endsection