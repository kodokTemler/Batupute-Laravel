@extends ('admin.layouts.app')

@section('karyawan')
<h1 class="h3 mb-2 text-gray-800">Tables Karyawan</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahKaryawan">
                                Tambah Karyawan
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
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th>Gender</th>
                                            <th>Agama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Nomor Hp</th>
                                            <th>Pend Terakhir</th>
                                            <th>Alamat</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $krywn )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if (empty($krywn->foto))
                                                    Tidak ada foto
                                                @else
                                                <a href="{{ asset('storage/assets/image/karyawan/' . $krywn->foto) }}" class="glightbox">
                                                    <img src="{{ asset('storage/assets/image/karyawan/' . $krywn->foto) }}" class="img-fluid rounded-circle" style="width: 85px;" alt="Foto Karyawan" />
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{$krywn->nama}}</td>
                                            <td>{{$krywn->email}}</td>
                                            <td>{{$krywn->jabatan}}</td>
                                            <td>{{$krywn->jenis_kelamin}}</td>
                                            <td>{{$krywn->agama}}</td>
                                            <td>{{$krywn->tanggal_lahir}}</td>
                                            <td>{{$krywn->nomor_hp}}</td>
                                            <td>{{$krywn->pendidikan_terakhir}}</td>
                                            <td>{{$krywn->alamat}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditKaryawan{{ $krywn->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusKaryawan{{ $krywn->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Karyawan -->
                                        <div class="modal fade" id="modalEditKaryawan{{ $krywn->id }}" tabindex="-1" role="dialog" aria-labelledby="editKaryawanLabel{{ $krywn->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.karyawan.update', $krywn->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit User</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- Kolom Kiri -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama</label>
                                                                        <input type="text" class="form-control" name="nama" id="nama" value="{{$krywn->nama}}"">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">Email</label>
                                                                        <input type="email" class="form-control" name="email" id="email" value="{{$krywn->email}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jabatan">Jabatan</label>
                                                                        <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{$krywn->jabatan}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kelamin">Jenis Kelamin</label><br>
                                                                        <div class="d-flex justify-content-around">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki" {{$krywn->jenis_kelamin === "Laki-laki" ? 'checked' : ''}} >
                                                                                <label class="form-check-label">Laki-laki</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan" {{$krywn->jenis_kelamin === "Perempuan" ? 'checked' : ''}} >
                                                                                <label class="form-check-label">Perempuan</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                        
                                                                <!-- Kolom Kanan -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="agama">Agama</label>
                                                                        <select name="agama" id="agama" class="form-control" required>
                                                                            <option selected disabled>-Pilih-</option>
                                                                            @foreach (['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu'] as $agama)
                                                                                <option value="{{ $agama }}" {{ $krywn->agama === $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pendidikan_terakhir">Pedidikan Terakhir</label>
                                                                        <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control">
                                                                            <option selected disabled>-Pilih-</option>
                                                                            @foreach (['SMP','SMA/SMK','D3 (Diploma 3)', 'D4 (Diploma 4)', 'S1 (Strata 1)', 'S2 (Strata 2)', 'S3 (Strata 3)'] as $pendidikan)
                                                                                <option value="{{ $pendidikan }}" {{ $krywn->pendidikan_terakhir === $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{$krywn->tanggal_lahir}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nomor_hp">Nomor Hp</label>
                                                                        <input type="tel" class="form-control" name="nomor_hp" id="nomor_hp" value="{{$krywn->nomor_hp}}">
                                                                    </div>
                                                                </div>
                                        
                                                                <!-- Alamat - Full Width -->
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="foto">Foto</label>
                                                                        <input type="file" class="form-control foto-input" name="foto" id="foto">
                                                                        <small class="error-message" style="color: red; display: none;"></small>
                                                                        @if ($krywn->foto)
                                                                            <div class="mt-3">
                                                                                <img src="{{ asset('storage/assets/image/karyawan/' . $krywn->foto) }}" alt="Foto Karyawan"  width="150" class="rounded">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat</label>
                                                                        <textarea class="form-control" name="alamat" id="alamat" rows="3">{{$krywn->alamat}}</textarea>
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

                                        <!-- Modal Hapus Karyawan -->
                                        <div class="modal fade" id="modalHapusKaryawan{{ $krywn->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusKaryawanLabel{{ $krywn->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.karyawan.delete', $krywn->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Yakin ingin menghapus Karyawan <strong>{{ $krywn->nama }}</strong>?</p>
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

<!-- Modal Tambah Karyawan -->
<div class="modal fade" id="modalTambahKaryawan" tabindex="-1" role="dialog" aria-labelledby="modalTambahKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> <!-- Hapus modal-lg agar ukuran normal -->
        <form action="{{ route('admin.karyawan.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" checked required>
                                    <label class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" required>
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select name="agama" id="agama" class="form-control" required>
                                    <option selected disabled>-Pilih-</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan_terakhir">Pedidikan Terakhir</label>
                                <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control" required>
                                    <option selected disabled>-Pilih-</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="D3 (Diploma 3)">D3 (Diploma 3)</option>
                                    <option value="D4 (Diploma 4)">D4 (Diploma 4)</option>
                                    <option value="S1 (Strata 1)">S1 (Strata 1)</option>
                                    <option value="S2 (Strata 2)">S2 (Strata 2)</option>
                                    <option value="S3 (Strata 3)">S3 (Strata 3)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor Hp</label>
                                <input type="tel" class="form-control" name="nomor_hp" required>
                            </div>
                        </div>

                        <!-- Alamat - Full Width -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control foto-input" name="foto" id="foto">
                                <small class="error-message" style="color: red; display: none;"></small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
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
document.getElementById("modalEditKaryawan").addEventListener("hidden.bs.modal", function () {
    document.querySelectorAll(".error-message").forEach(el => {
        el.style.display = "none";
    });
});

</script>
@endsection