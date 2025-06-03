@extends ('admin.layouts.app')
@section('users')
<h1 class="h3 mb-2 text-gray-800">Tables User</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahUser">
                                Tambah User
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
                                            <th>Email</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Nomor Hp</th>
                                            <th>Gander</th>
                                            <th>Alamat</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->tempat_lahir}}, {{$user->tanggal_lahir}}</td>
                                            <td>{{$user->nomor_hp}}</td>
                                            <td>{{$user->jenis_kelamin}}</td>
                                            <td>{{$user->alamat}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditUser{{ $user->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusUser{{ $user->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit User -->
                                        <div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                                @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit User</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nama</label>
                                                                        <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Password Baru (Opsional)</label>
                                                                        <input type="password" class="form-control" name="password">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Konfirmasi Password Baru</label>
                                                                        <input type="password" class="form-control" name="password_confirmation">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Tempat Lahir</label>
                                                                        <input type="text" class="form-control" name="tempat_lahir" value="{{$user->tempat_lahir}}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Tanggal Lahir</label>
                                                                        <input type="date" class="form-control" name="tanggal_lahir" value="{{$user->tanggal_lahir}}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nomor Hp</label>
                                                                        <input type="tel" class="form-control" name="nomor_hp" value="{{$user->nomor_hp}}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jenis Kelamin</label><br>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" {{$user->jenis_kelamin === "Laki-laki" ? 'checked' : ''}} required>
                                                                            <label class="form-check-label">Laki-laki</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" {{$user->jenis_kelamin === "Perempuan" ? 'checked' : ''}} required>
                                                                            <label class="form-check-label">Perempuan</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat</label>
                                                                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{$user->alamat}}</textarea>
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

                                        <!-- Modal Hapus User -->
                                        <div class="modal fade" id="modalHapusUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusUserLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Yakin ingin menghapus Account <strong>{{ $user->name }}</strong>?</p>
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

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> <!-- Hapus modal-lg agar ukuran normal -->
        <form action="{{ route('admin.users.store') }}" method="POST">
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
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor Hp</label>
                                <input type="tel" class="form-control" name="nomor_hp" required>
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

                        <!-- Alamat - Full Width -->
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



@endsection
