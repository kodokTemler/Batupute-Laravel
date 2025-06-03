@extends ('admin.layouts.app')
@section('transparansi-anggaran')
<h1 class="h3 mb-2 text-gray-800">Tables Transparansi Anggaran</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDataTransparansiAnggaran">
                                <i class="fas fa-plus"></i>
                                Tambah Data Anggaran
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
                                            <th>Tahun</th>
                                            <th>Sumber Dana</th>
                                            <th>Jumlah</th>
                                            <th>Jenis Penggunaan</th>
                                            <th>Kategori</th>
                                            <th>File Bukti</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tranparansiAnggaran as $transAng )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$transAng->tahun}}</td>
                                            <td>{{$transAng->sumber_dana}}</td>
                                            <td>Rp. {{number_format($transAng->jumlah_anggaran, 0, ',' , '.')}}</td>
                                            <td>{{$transAng->jenis_penggunaan}}</td>
                                            <td>{{$transAng->kategori}}</td>
                                            <td class="text-wrap" style="max-width: 150px;">
                                                <a href="{{ asset('storage/assets/documents/transparansiAnggaran/' . $transAng->file_bukti) }}" target="_blank">
                                                Lihat File
                                                </a>
                                            </td>
                                            <td class="text-wrap" style="max-width: 200px;">{{$transAng->keterangan}}</td>
                                            <td>{{$transAng->status}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDataTransparansiAnggaran{{ $transAng->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDataTransparansiAnggaran{{ $transAng->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditDataTransparansiAnggaran{{ $transAng->id }}" tabindex="-1" role="dialog" aria-labelledby="editDataTransparansiAnggaranLabel{{ $transAng->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.transparansi-anggaran.update', $transAng->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Transparansi Anggaran</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tahun Anggaran</label>
                                                                <input type="number" class="form-control" name="tahun" min="1900" max="2099" step="1" placeholder="YYYY" value="{{$transAng->tahun}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Sumber Dana</label>
                                                                <input type="text" class="form-control" name="sumber_dana" placeholder="Masukkan Sumber Dana" value="{{$transAng->sumber_dana}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jumlah Anggaran</label>
                                                                <input type="number" class="form-control" name="jumlah_anggaran" min="0" placeholder="Rp." value="{{$transAng->jumlah_anggaran}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Jenis Penggunaan</label>
                                                                <input type="text" class="form-control" name="jenis_penggunaan" placeholder="Masukkan Jenis Penggunaan" value="{{$transAng->jenis_penggunaan}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kategori">Kategori</label>
                                                                <select name="kategori" id="kategori" class="form-control">
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Pendapatan', 'Pengeluaran'] as $kategori)
                                                                        <option value="{{ $kategori }}" {{$transAng->kategori == $kategori ? 'selected' : ''}}>{{$kategori}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Draft', 'Publish'] as $status)
                                                                        <option value="{{$status}}" {{$transAng->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="file_bukti">File Laporan</label>
                                                                <input class="form-control file-input" type="file" name="file_bukti" id="file_bukti">
                                                                <small class="error-message" style="color: red; display: none;"></small>
                                                                @if (!empty($transAng->file_bukti))
                                                                <div class="mt-2 text-center">
                                                                    <label>File Sebelumnya:</label><br>
                                                                    <a href="{{ asset('storage/assets/documents/transparansiAnggaran/' . $transAng->file_bukti) }}" target="_blank">
                                                                        Lihat File ({{ $transAng->file_bukti }})
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{$transAng->keterangan}}</textarea>
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
                                        <div class="modal fade" id="modalHapusDataTransparansiAnggaran{{ $transAng->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataTransparansiAnggaranLabel{{ $transAng->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.transparansi-anggaran.delete', $transAng->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Yakin ingin menghapus Transparansi Anggaran <strong>{{ $transAng->tahun }}, {{ $transAng->file_bukti}}</strong>?</p>
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
                    <!-- Modal Tambah Transparansi Anggaran -->
                    <div class="modal fade" id="modalTambahDataTransparansiAnggaran" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataTransparansiAnggaranLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.transparansi-anggaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Transparansi Anggaran</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tahun Anggaran</label>
                                            <input type="number" class="form-control" name="tahun" min="1900" max="2099" step="1" placeholder="YYYY" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber Dana</label>
                                            <input type="text" class="form-control" name="sumber_dana" placeholder="Masukkan Sumber Dana" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Anggaran</label>
                                            <input type="number" class="form-control" name="jumlah_anggaran" min="0" placeholder="Rp." required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Penggunaan</label>
                                            <input type="text" class="form-control" name="jenis_penggunaan" placeholder="Masukkan Jenis Penggunaan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select name="kategori" id="kategori" class="form-control" required>
                                                <option selected disabled>-Pilih-</option>
                                                <option value="Pendapatan">Pendapatan</option>
                                                <option value="Pengeluaran">Pengeluaran</option>
                                            </select>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="file_bukti">File Laporan</label>
                                            <input class="form-control file-input" type="file" name="file_bukti" id="file_bukti">
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
document.getElementById("modalEditDataTransparansiAnggaran").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});

</script>
@endsection