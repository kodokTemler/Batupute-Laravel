@extends ('admin.layouts.app')

@section('data-penduduk')
<h1 class="h3 mb-2 text-gray-800">Tables Data Penduduk</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDataPenduduk">
                                Tambah Data Penduduk
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
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPenduduk as $dapen )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$dapen->kategori}}</td>
                                            <td>{{$dapen->jumlah}} Jiwa</td>
                                            
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDataPenduduk{{ $dapen->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDataPenduduk{{ $dapen->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit User -->
                                        <div class="modal fade" id="modalEditDataPenduduk{{ $dapen->id }}" tabindex="-1" role="dialog" aria-labelledby="editDataPendudukLabel{{ $dapen->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.data-penduduk.update', $dapen->id) }}" method="POST">
                                                @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data Penduduk</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="kategori">Kategori</label>
                                                                        <input type="text" class="form-control" name="kategori" value="{{$dapen->kategori}}" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jumlah</label>
                                                                        <input type="number" class="form-control" name="jumlah" value="{{$dapen->jumlah}}">
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
                                        <div class="modal fade" id="modalHapusDataPenduduk{{ $dapen->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataPendudukLabel{{ $dapen->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.data-penduduk.delete', $dapen->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Yakin ingin menghapus kategori ini {{$dapen->kategori}}</p>
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
<div class="modal fade" id="modalTambahDataPenduduk" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataPendudukLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> <!-- Hapus modal-lg agar ukuran normal -->
        <form action="{{ route('admin.data-penduduk.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Penduduk</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <option selected disabled>-Pilih-</option>
                                    @foreach ($semuaKategori as $itemKategori)
                                        <option value="{{ $itemKategori }}" {{ in_array($itemKategori, $kategori) ? 'disabled' : '' }}>
                                            {{ $itemKategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah" required>
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