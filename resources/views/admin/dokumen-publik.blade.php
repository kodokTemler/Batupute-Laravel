@extends('admin.layouts.app')
@section('dokumen-publik')
<h1 class="h3 mb-2 text-gray-800">Tables Data Dokumen Publik</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDokumenPublik">
                                <i class="fas fa-plus"></i>
                                Tambah Data Dokumen Publik
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
                                            <th>Nama Dokumen</th>
                                            <th>Kategori</th>
                                            <th>Tahun</th>
                                            <th>File Dokumen</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokumenPublik as $doPub )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$doPub->nama_dokumen}}</td>
                                            <td>{{$doPub->kategori}}</td>
                                            <td>{{$doPub->tahun}}</td>
                                            <td>{{$doPub->file_dokumen}}</td>
                                            <td>{{$doPub->status}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDokumenPublik{{ $doPub->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDokumenPublik{{ $doPub->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditDokumenPublik{{$doPub->id}}" tabindex="-1" role="dialog" aria-labelledby="editDokumenPublikLabel{{ $doPub->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.dokumen-publik.update', $doPub->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Edit Dokumen Publik</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nama_dokumen">Nama Dokumen</label>
                                                                <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" placeholder="Masukkan Nama Dokumen" value="{{$doPub->nama_dokumen}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kategori">Kategori</label>
                                                                <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Masukkan Kategori" value="{{$doPub->kategori}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tahun">Tahun</label>
                                                                <input type="number" class="form-control" name="tahun" id="tahun" min="1999" max="2099" step="1" placeholder="YYYY" value="{{$doPub->tahun}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="file_dokumen">File Dokumen</label>
                                                                <input type="file" class="form-control file-input" name="file_dokumen" id="file_dokumen">
                                                                <small class="error-message" style="color: red; display: none;"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            @if (!empty($doPub->file_dokumen))
                                                                <div class="form-group">
                                                                    <div class="mt-2 text-center">
                                                                        <label>File Sebelumnya:</label><br>
                                                                        <a href="{{ asset('storage/assets/documents/dokumenPublik/' . $doPub->file_dokumen) }}" target="_blank">
                                                                            Lihat File ({{ $doPub->file_dokumen }})
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Publish','Draft'] as $status)
                                                                        <option value="{{$status}}" {{$doPub->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                                                    @endforeach
                                                                </select>
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
                                        <div class="modal fade" id="modalHapusDokumenPublik{{ $doPub->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDokumenPublikLabel{{ $doPub->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.dokumen-publik.delete', $doPub->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <p>Yakin ingin menghapus Dokumen Publik ini <strong>{{ $doPub->nama_dokumen }}</strong>?</p>
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
                    <div class="modal fade" id="modalTambahDokumenPublik" tabindex="-1" role="dialog" aria-labelledby="modalTambahDokumenPublikLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.dokumen-publik.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Dokumen Publikk</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_dokumen">Nama Dokumen</label>
                                            <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" placeholder="Masukkan Nama Dokumen" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Masukkan Kategori" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tahun">Tahun</label>
                                            <input type="number" class="form-control" name="tahun" id="tahun" min="1999" max="2099" step="1" placeholder="YYYY" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="file_dokumen">File Dokumen</label>
                                            <input type="file" class="form-control file-input" name="file_dokumen" id="file_dokumen" required>
                                            <small class="error-message" style="color: red; display: none;"></small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option selected disabled>-Pilih-</option>
                                                <option value="Draft">Draft</option>
                                                <option value="Publish">Publish</option>
                                            </select>
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
document.getElementById("modalEditDokumenPublik").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});
</script>
@endsection