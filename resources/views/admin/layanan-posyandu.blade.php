@extends('admin.layouts.app')
@section('posyandu')
<h1 class="h3 mb-2 text-gray-800">Tables Data Layanan Posyandu</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <!-- Tombol Tambah -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahDataPosyandu">
                                <i class="fas fa-plus"></i>
                                Tambah Data Posyandu
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
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Status</th>
                                            <th>Lokasi</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($layananPosyandu as $lapos )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$lapos->nama_pelayanan}}</td>
                                            <td>{{$lapos->kategori}}</td>
                                            <td>{{$lapos->tanggal_pelayanan}}</td>
                                            <td>{{ \Carbon\Carbon::parse($lapos->jam_mulai)->format('H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lapos->jam_selesai)->format('H:i') }}</td>
                                            <td>{{$lapos->status}}</td>
                                            <td>{{$lapos->lokasi}}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditDataPosyandu{{ $lapos->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusDataPosyandu{{ $lapos->id }}">
                                                        <i class="fas fa-trash-alt"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Modal Edit Admin -->
                                        <div class="modal fade" id="modalEditDataPosyandu{{ $lapos->id }}" tabindex="-1" role="dialog" aria-labelledby="editDataPosyanduLabel{{ $lapos->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-posyandu.update', $lapos->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Posyandu</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nama_pelayanan">Nama Pelayanan</label>
                                                                <input type="text" class="form-control" name="nama_pelayanan" id="nama_pelayanan" value="{{$lapos->nama_pelayanan}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kategori">Ketogori</label>
                                                                <input type="text" class="form-control" name="kategori" id="kategori" value="{{$lapos->kategori}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggal_pelayanan">Tanggal Pelayanan</label>
                                                                <input type="date" class="form-control" name="tanggal_pelayanan" id="tanggal_pelayanan" value="{{$lapos->tanggal_pelayanan}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="jam_mulai">Jam Mulai</label>
                                                                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="{{ \Carbon\Carbon::parse($lapos->jam_mulai)->format('H:i') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jam_selesai">Jam Selesai</label>
                                                                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="{{ \Carbon\Carbon::parse($lapos->jam_selesai)->format('H:i') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option selected disabled>-Pilih-</option>
                                                                    @foreach (['Draft', 'Publish'] as $status)
                                                                        <option value="{{$status}}" {{$lapos->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md 12">
                                                            <div class="form-group">
                                                                <label for="lokasi">Lokasi</label>
                                                                <textarea class="form-control" name="lokasi" id="lokasi" rows="3">{{$lapos->lokasi}}</textarea>
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
                                        <div class="modal fade" id="modalHapusDataPosyandu{{ $lapos->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusDataPosyanduLabel{{ $lapos->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('admin.layanan-posyandu.delete', $lapos->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <p>Yakin ingin menghapus Layanan Posyandu ini <strong>{{ $lapos->nama_pelayanan }}</strong>?</p>
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
                    <div class="modal fade" id="modalTambahDataPosyandu" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataPosyanduLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.layanan-posyandu.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Layanan Posyandu</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_pelayanan">Nama Pelayanan</label>
                                            <input type="text" class="form-control" name="nama_pelayanan" id="nama_pelayanan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Ketogori</label>
                                            <input type="text" class="form-control" name="kategori" id="kategori" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_pelayanan">Tanggal Pelayanan</label>
                                            <input type="date" class="form-control" name="tanggal_pelayanan" id="tanggal_pelayanan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jam_mulai">Jam Mulai</label>
                                            <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam_selesai">Jam Selesai</label>
                                            <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" required>
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
                                    <div class="col-md 12">
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi</label>
                                            <textarea class="form-control" name="lokasi" id="lokasi" rows="3" required></textarea>
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