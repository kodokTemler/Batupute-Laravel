@extends('admin.layouts.app')
@section('transparansi-bumdes')
<h1 class="h3 mb-2 text-gray-800">Tables Data Transparansi Bumdes</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDokumenBumdes">
                                <i class="fas fa-plus"></i>
                                Tambah Data Dokumen Bumdes
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
                                            <th>Tahun</th>
                                            <th>File Dokumen</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transparansiBumdes as $bumdes )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$bumdes->judul}}</td>
                                            <td>{{$bumdes->tahun}}</td>
                                            <td>{{$bumdes->file_bukti}}</td>
                                            <td>{{$bumdes->status}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDokumenBumdes{{ $bumdes->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDokumenBumdes{{ $bumdes->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditDokumenBumdes{{$bumdes->id}}" tabindex="-1" role="dialog" aria-labelledby="editDokumenBumdesLabel{{ $bumdes->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.transparansi-bumdes.update', $bumdes->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Edit Dokumen Publik</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="judul">Judul</label>
                                                                <input type="text" class="form-control" name="judul" id="judul" value="{{$bumdes->judul}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tahun">Tahun</label>
                                                                <input type="number" class="form-control" name="tahun" id="tahun" min="1999" max="2099" step="1" placeholder="YYYY" value="{{$bumdes->tahun}}">
                                                            </div>
                                                             <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Publish','Draft'] as $status)
                                                                        <option value="{{$status}}" {{$bumdes->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="file_bukti">File Dokumen</label>
                                                                <input type="file" class="form-control file-input" name="file_bukti" id="file_bukti">
                                                                <small class="error-message" style="color: red; display: none;"></small>
                                                            </div>
                                                             @if (!empty($bumdes->file_bukti))
                                                                <div class="form-group">
                                                                    <div class="mt-2 text-center">
                                                                        <label>File Sebelumnya:</label><br>
                                                                        <a href="{{ asset('storage/assets/documents/transparansiBumdes/' . $bumdes->file_bukti) }}" target="_blank">
                                                                            Lihat File ({{ $bumdes->file_bukti }})
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
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
                                        <div class="modal fade" id="modalHapusDokumenBumdes{{ $bumdes->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDokumenBumdesLabel{{ $bumdes->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.transparansi-bumdes.delete', $bumdes->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <p>Yakin ingin menghapus Dokumen Transparansi Bumdes ini <strong>{{ $bumdes->judul }}</strong>?</p>
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
                    <div class="modal fade" id="modalTambahDokumenBumdes" tabindex="-1" role="dialog" aria-labelledby="modalTambahDokumenBumdesLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.transparansi-bumdes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Transparnsi Bumdes</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="judul">Judul</label>
                                            <input type="text" class="form-control" name="judul" id="judul" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun">Tahun</label>
                                            <input type="number" class="form-control" name="tahun" id="tahun" min="1999" max="2099" step="1" placeholder="YYYY" required>
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
                                            <label for="file_bukti">File Dokumen</label>
                                            <input type="file" class="form-control file-input" name="file_bukti" id="file_bukti" required>
                                            <small class="error-message" style="color: red; display: none;"></small>
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
document.getElementById("modalEditDokumenBumdes").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});
</script>
@endsection