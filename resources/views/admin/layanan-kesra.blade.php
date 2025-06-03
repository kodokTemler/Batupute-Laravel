@extends('admin.layouts.app')
@section('kesra')
<h1 class="h3 mb-2 text-gray-800">Tables Data Kesra</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDataKesra">
                                <i class="fas fa-plus"></i>
                                Tambah Data Kesra
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
                                            <th>Nama Layanan</th>
                                            <th>Jenis Bantuan</th>
                                            <th>Tahun</th>
                                            <th>File Dokumen</th>
                                            <th>Status</th>
                                            <th>Deskripsi</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($layananKesra as $laykes )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$laykes->nama_layanan}}</td>
                                            <td>{{$laykes->jenis_bantuan}}</td>
                                            <td>{{$laykes->tahun}}</td>
                                            <td class="text-wrap" style="max-width: 150px;">
                                                @if (!empty($laykes->file_dokumen))
                                                    <a href="{{ asset('storage/assets/documents/layananKesra/' . $laykes->file_dokumen) }}" target="_blank">
                                                        Lihat File
                                                    </a>
                                                @else
                                                    Tidak ada file dokumen
                                                @endif
                                            </td>
                                            <td>{{$laykes->status}}</td>
                                            <td>{!! nl2br(e($laykes->deskripsi)) !!}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDataKesra{{ $laykes->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDataKesra{{ $laykes->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditDataKesra{{ $laykes->id }}" tabindex="-1" role="dialog" aria-labelledby="editDataKesraLabel{{ $laykes->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-kesra.update', $laykes->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Pekerjaan Penduduk</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nama_layanan">Nama Layanan</label>
                                                                <input type="text" class="form-control" name="nama_layanan" id="nama_layanan" value="{{$laykes->nama_layanan}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tahun">Tahun</label>
                                                                <input type="number" class="form-control" name="tahun" min="1900" max="2099" step="1" value="{{$laykes->tahun}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-ms-6">
                                                            <div class="form-group">
                                                                <label for="jenis_bantuan">Jenis Bantuan</label>
                                                                <input type="text" class="form-control" name="jenis_bantuan" id="jenis_bantuan" value="{{$laykes->jenis_bantuan}}">
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control" required>
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Draft', 'Publish'] as $status)
                                                                        <option value="{{$status}}" {{$laykes->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="file_dokumen">File Dokumen</label>
                                                                <input type="file" class="form-control file-input" name="file_dokumen" id="file_dokumen">
                                                                <small class="error-message" style="color: red; display: none;"></small>
                                                                @if (!empty($laykes->file_dokumen))
                                                                    <div class="mt-2 text-center">
                                                                        <label>File Sebelumnya:</label><br>
                                                                        <a href="{{ asset('storage/assets/documents/layananKesra/' . $laykes->file_dokumen) }}" target="_blank">
                                                                            Lihat File ({{ $laykes->file_dokumen }})
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="deskripsi">Deskripsi</label>
                                                                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="5">{{$laykes->deskripsi}}</textarea>
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
                                        <div class="modal fade" id="modalHapusDataKesra{{ $laykes->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataKesraLabel{{ $laykes->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-kesra.delete', $laykes->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <p>Yakin ingin menghapus Jenis layanan ini <strong>{{ $laykes->nama_layanan }}</strong>?</p>
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
                    <div class="modal fade" id="modalTambahDataKesra" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataKesraLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.layanan-kesra.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Kesra</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_layanan">Nama Layanan</label>
                                            <input type="text" class="form-control" name="nama_layanan" id="nama_layanan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun">Tahun</label>
                                            <input type="number" class="form-control" name="tahun" required min="1900" max="2099" step="1" required>
                                        </div>
                                       
                                    </div>
                                    <div class="col-ms-6">
                                        <div class="form-group">
                                            <label for="jenis_bantuan">Jenis Bantuan</label>
                                            <input type="text" class="form-control" name="jenis_bantuan" id="jenis_bantuan" required>
                                        </div>
                                        <div class="form-group">
                                           <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option selected disabled>-Pilih-</option>
                                                <option value="Draft">Draft</option>
                                                <option value="Publish">Publish</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file_dokumen">File Dokumen</label>
                                            <input type="file" class="form-control file-input" name="file_dokumen" id="file_dokumen">
                                            <small class="error-message" style="color: red; display: none;"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="5"></textarea>
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

// Reset error saat modal ditutup (gantilah #modalEditKaryawan dengan ID modal-mu)
document.getElementById("modalEditDataKesra").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});
</script>
@endsection