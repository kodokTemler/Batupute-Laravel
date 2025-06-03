@extends('admin.layouts.app')
@section('pelayanan')
<h1 class="h3 mb-2 text-gray-800">Tables Data Pelayanan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDataPelayanan">
                                <i class="fas fa-plus"></i>
                                Tambah Data Pelayanan
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
                                            <th>Nama Pelayanan</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($layananPelayanan as $lapen )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$lapen->nama_layanan}}</td>
                                            <td>{!! nl2br(e($lapen->deskripsi)) !!}</td>
                                            <td>{{$lapen->status}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDataPelayanan{{ $lapen->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDataPelayanan{{ $lapen->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditDataPelayanan{{ $lapen->id }}" tabindex="-1" role="dialog" aria-labelledby="editDataPelayananLabel{{ $lapen->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-pelayanan.update', $lapen->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Pelayanan</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="nama_layanan">Nama Layanan</label>
                                                                <input type="text" class="form-control" name="nama_layanan" id="nama_layanan" value="{{ $lapen->nama_layanan }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Draft', 'Publish'] as $status)
                                                                        <option value="{{ $status }}" {{ $lapen->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="deskripsi">Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6">{{$lapen->deskripsi}}</textarea>
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
                                        <div class="modal fade" id="modalHapusDataPelayanan{{ $lapen->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataPelayananLabel{{ $lapen->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-pelayanan.delete', $lapen->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <p>Yakin ingin menghapus Jenis Pelayanan ini <strong>{{ $lapen->nama_layanan }}</strong>?</p>
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
                    <div class="modal fade" id="modalTambahDataPelayanan" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataPelayananLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.layanan-pelayanan.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Pelayanan</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_layanan">Nama Layanan</label>
                                    <input type="text" class="form-control" name="nama_layanan" id="nama_layanan" required>
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
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="6" required></textarea>
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