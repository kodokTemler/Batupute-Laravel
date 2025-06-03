@extends ('admin.layouts.app')
@section('laporan-kegiatan')
<h1 class="h3 mb-2 text-gray-800">Tables Laporan Kegiatan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahLaporanKegiatan">
                                <i class="fas fa-plus"></i>
                                Tambah Laporan Kegiatan
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
                                            <th>Nama Kegiatan</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Lokasi</th>
                                            <th>Jumlah Anggaran</th>
                                            <th>File Laporan</th>
                                            <th>Foto Kegiatan</th>
                                            <th>Status</th>
                                            <th>Deskripsi</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporanKegiatan as $lakegi )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$lakegi->nama_kegiatan}}</td>
                                            <td>{{$lakegi->tanggal_kegiatan}}</td>
                                            <td>{{$lakegi->lokasi}}</td>
                                            <td>Rp. {{number_format($lakegi->anggaran, 0, ',', '.')}}</td>
                                            <td>
                                                <a href="{{asset('storage/assets/documents/laporanKegiatan/'.$lakegi->file_laporan)}}" target="_blank">
                                                Lihat File
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{asset('storage/assets/image/laporanKegiatan/' .$lakegi->foto_kegiatan)}}" class="glightbox">
                                                    <img src="{{asset('storage/assets/image/laporanKegiatan/' .$lakegi->foto_kegiatan)}}" class="img-fluid rounded" style="width: 85px;" alt="Foto Karyawan" />
                                                </a>
                                            </td>
                                            <td>{{$lakegi->status}}</td>
                                            <td>{{$lakegi->deskripsi}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditLaporanKegiatan{{ $lakegi->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusLaporanKegiatan{{ $lakegi->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditLaporanKegiatan{{ $lakegi->id }}" tabindex="-1" role="dialog" aria-labelledby="editLaporanKegiatanLabel{{ $lakegi->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.laporan-kegiatan.update', $lakegi->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Laporan Kegiatan</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nama_kegiatan">Nama Kegiatan</label>
                                                                <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" value="{{$lakegi->nama_kegiatan}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                                                <input type="date" class="form-control" name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{$lakegi->tanggal_kegiatan}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lokasi">Lokasi Kegiatan</label>
                                                                <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{$lakegi->lokasi}}">
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="anggaran">Jumlah Anggaran</label>
                                                                <input type="number" class="form-control" name="anggaran" id="anggaran" min="0" value="{{$lakegi->anggaran}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control" required>
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Draft', 'Publish'] as $status)
                                                                        <option value="{{$status}}" {{$lakegi->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="file_laporan">File Laporan</label>
                                                                <input type="file" class="form-control file-input" name="file_laporan" id="file_laporan">
                                                                <small class="error-message" style="color: red; display: none;"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            @if (!empty($lakegi->file_laporan))
                                                                <div class="mt-2 text-center">
                                                                    <label>File Sebelumnya:</label><br>
                                                                    <a href="{{ asset('storage/assets/documents/laporanKegiatan/' . $lakegi->file_laporan) }}" target="_blank">
                                                                        Lihat File ({{ $lakegi->file_laporan }})
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="foto_kegiatan">Foto Kegiatan</label>
                                                                <input type="file" class="form-control foto-input" name="foto_kegiatan" id="foto_kegiatan">
                                                                <small class="error-message" style="color: red; display: none;"></small>
                                                                @if(!empty($lakegi->foto_kegiatan))
                                                                    <div class="mt-3 text-center">
                                                                        <img src="{{asset('storage/assets/image/laporanKegiatan/'. $lakegi->foto_kegiatan)}}" alt="Foto Kegiatan"  width="150" class="rounded">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="deskripsi">Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{$lakegi->deskripsi}}</textarea>
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
                                        <div class="modal fade" id="modalHapusLaporanKegiatan{{ $lakegi->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusLaporanKegiatanLabel{{ $lakegi->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.laporan-kegiatan.delete', $lakegi->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Yakin ingin menghapus Laporan Kegiatan <strong>{{ $lakegi->nama_kegiatan }}</strong>?</p>
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
                    <div class="modal fade" id="modalTambahLaporanKegiatan" tabindex="-1" role="dialog" aria-labelledby="modalTambahLaporanKegiatanLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.laporan-kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Laporan Kegiatan</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                            <input type="date" class="form-control" name="tanggal_kegiatan" id="tanggal_kegiatan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi Kegiatan</label>
                                            <input type="text" class="form-control" name="lokasi" id="lokasi" required>
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="anggaran">Jumlah Anggaran</label>
                                            <input type="number" class="form-control" name="anggaran" id="anggaran" min="0" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option selected disabled>-Pilih-</option>
                                                <option value="Draft">Draft</option>
                                                <option value="Publish">Publish</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="file_laporan">File Laporan</label>
                                            <input type="file" class="form-control file-input" name="file_laporan" id="file_laporan">
                                            <small class="error-message" style="color: red; display: none;"></small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="foto_kegiatan">Foto Kegiatan</label>
                                            <input type="file" class="form-control foto-input" name="foto_kegiatan" id="foto_kegiatan">
                                            <small class="error-message" style="color: red; display: none;"></small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required></textarea>
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
     document.querySelectorAll(".file-input").forEach(function(input) {
    input.addEventListener("change", function() {
        const file = this.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB

        // Format yang diperbolehkan: PDF, Word, Excel
        const allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        const errorMessage = this.closest(".form-group").querySelector(".error-message");

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                errorMessage.textContent = "Format file tidak sesuai! (Hanya PDF, Word, Excel)";
                errorMessage.style.display = "block";
                this.value = ""; // Reset input file
            } else if (file.size > maxSize) {
                errorMessage.textContent = "Ukuran file melebihi 5MB!";
                errorMessage.style.display = "block";
                this.value = ""; // Reset input file
            } else {
                errorMessage.style.display = "none";
            }
        }
    });
});

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
document.getElementById("modalEditLaporanKegiatan").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});
</script>
@endsection