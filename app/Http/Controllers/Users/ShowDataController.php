<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\DataPenduduk;
use App\Models\DataPekerjaanPenduduk;
use Illuminate\Http\Request;
use App\Models\TransparansiAnggaran;
use App\Models\DokumenPublik;
use App\Models\LaporanKegiatan;
use App\Models\LayananPemerintahan;
use App\Models\LayananPelayanan;
use App\Models\LayananPosyandu;
use App\Models\LayananKesra;
use App\Models\TransparansiBumdes;
use Vish4395\LaravelFileViewer\LaravelFileViewer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ShowDataController extends Controller
{
    public function showData()
    {
        $karyawan = Karyawan::select('nama', 'jabatan', 'jenis_kelamin', 'foto')->get();
        // Ambil semua data penduduk
        $dataPenduduk = DataPenduduk::all();

        // Cek jika kosong, tetap jadikan koleksi kosong
        if ($dataPenduduk->isEmpty()) {
            $dataPenduduk = collect();
        }

        // Kategori yang ingin diambil
        $kategoriList = [
            'Jumlah Penduduk',
            'Laki-laki',
            'Perempuan',
            'Kepala Keluarga',
            'Penduduk Sementara',
            'Penduduk Mutasi',
        ];

        // Ambil data sesuai kategori
        $filtered = DataPenduduk::whereIn('kategori', $kategoriList)->get();

        // Inisialisasi default jumlah untuk tiap kategori
        $jumlahData = [
            'Jumlah Penduduk' => 0,
            'Laki-laki' => 0,
            'Perempuan' => 0,
            'Kepala Keluarga' => 0,
            'Penduduk Sementara' => 0,
            'Penduduk Mutasi' => 0,
        ];

        // Isi nilai jika ditemukan
        foreach ($filtered as $item) {
            if (in_array($item->kategori, $kategoriList)) {
                $jumlahData[$item->kategori] = $item->jumlah;
            }
        }
        return view('index', compact('karyawan', 'dataPenduduk', 'jumlahData'));
    }

    public function showDataBerita()
    {
        $berita = Berita::where('status', 'Publish')->paginate(6);
        return view('berita', compact('berita'));
    }

    public function detailBerita($id)
    {
        $beritaDetail = Berita::findOrFail($id);

        // Ambil 5 berita lain, tidak termasuk yang sedang dibuka
        $beritaLainnya = Berita::where('id', '!=', $id)
            ->latest()
            ->take(5)
            ->get();

        return view('berita.berita-detail', compact('beritaDetail', 'beritaLainnya'));
    }

    public function showDataGaleri()
    {
        $galeri = Galeri::where('status', 'Publish')->paginate(6);
        return view('galeri', compact('galeri'));
    }

    public function detailGaleri($id)
    {
        $galeriDetail = Galeri::findOrFail($id);
        return view('galeri.galeri-detail', compact('galeriDetail'));
    }

    public function dataPendudukChart()
    {
        // Daftar kategori usia yang ingin dicek
        $kategoriUsia = [
            'Usia 0-17 Tahun',
            'Usia 18-55 Tahun',
            'Usia 55 ke-atas',
        ];

        // Ambil semua data dari kategori tersebut
        $data = DataPenduduk::whereIn('kategori', $kategoriUsia)->get();

        // Inisialisasi label dan nilai
        $dataKategori = [];
        $dataJumlah = [];

        // Loop kategori dan isi nilai (default 0 jika tidak ada)
        foreach ($kategoriUsia as $kategori) {
            $item = $data->firstWhere('kategori', $kategori);
            $dataKategori[] = $kategori;
            $dataJumlah[] = $item ? $item->jumlah : 0;
        }

        // Siapkan untuk chart atau tampilan
        $labels = $dataKategori;
        $values = $dataJumlah;

        // Data Pekerjaan
        $pekerjaanData = DataPekerjaanPenduduk::all();
        $pekerjaanLabels = $pekerjaanData->pluck('pekerjaan')->toArray();
        $pekerjaanJumlah = $pekerjaanData->pluck('jumlah')->toArray();

        if (!$pekerjaanData) {
            $pekerjaanData = (object)[
                'pekerjaanLabels' => 0,
                'pekerjaanJumlah' => 0,
            ];
        }
        // Warna untuk chart
        $colors = [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)'
        ];

        $borderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ];

        return view('dapen.dapen-detail', compact('labels', 'labels', 'values', 'pekerjaanLabels', 'pekerjaanJumlah', 'colors', 'borderColors'));
    }

    public function transparansiAnggaran(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        $data = TransparansiAnggaran::where('tahun', $tahun)
            ->where('status', 'Publish')
            ->get();

        $pemasukan = $data->where('kategori', 'Pendapatan')->sum('jumlah_anggaran');
        $pengeluaran = $data->where('kategori', 'Pengeluaran')->sum('jumlah_anggaran');
        $surplus = $pemasukan - $pengeluaran;

        return response()->json([
            'tahun' => $tahun,
            'pemasukan' => number_format($pemasukan, 2, ',', '.'),
            'pengeluaran' => number_format($pengeluaran, 2, ',', '.'),
            'surplus' => number_format($surplus, 2, ',', '.'),
        ]);
    }

    public function dataTransparansiAnggaran()
    {
        // Grafik Anggaran
        $rawData = TransparansiAnggaran::where('status', 'Publish')
            ->select('tahun', 'kategori', DB::raw('SUM(jumlah_anggaran) as total'))
            ->groupBy('tahun', 'kategori')
            ->orderBy('tahun')
            ->get();

        // Siapkan data dalam format: tahun => [pendapatan => xxx, pengeluaran => yyy]
        $dataTahun = [];

        foreach ($rawData as $item) {
            $tahun = $item->tahun;
            $kategori = strtolower($item->kategori); // pendapatan / pengeluaran

            if (!isset($dataTahun[$tahun])) {
                $dataTahun[$tahun] = [
                    'Pendapatan' => 0,
                    'Pengeluaran' => 0,
                ];
            }

            if ($kategori === 'pendapatan') {
                $dataTahun[$tahun]['Pendapatan'] = $item->total;
            } elseif ($kategori === 'pengeluaran') {
                $dataTahun[$tahun]['Pengeluaran'] = $item->total;
            }
        }

        $labels = array_keys($dataTahun);
        $pendapatan = array_column($dataTahun, 'Pendapatan');
        $pengeluaran = array_column($dataTahun, 'Pengeluaran');
        // End Grafik Anggaran

        // daftar transparansi anggaran
        $transparansiAnggaran = TransparansiAnggaran::where('status', 'Publish')
            ->orderBy('tahun', 'desc')
            ->paginate(6);


        return view('transparansi.transparansi-anggaran', compact('labels', 'pendapatan', 'pengeluaran', 'transparansiAnggaran'));
    }

    public function dataDokumenPublik()
    {
        $dokumenPublik = DokumenPublik::where('status', 'Publish')
            ->orderBy('tahun', 'desc')
            ->paginate(6);

        return view('transparansi.dokumen-publik', compact('dokumenPublik'));
    }

    public function previewDokumenPublik($filename)
    {
        $relativePath = 'assets/documents/dokumenPublik/' . $filename;
        $filepath = 'public/' . $relativePath;
        $file_url = asset('storage/' . $relativePath);

        if (!Storage::exists($filepath)) {
            abort(404, 'File tidak ditemukan');
        }

        $file_data = [
            ['label' => 'Nama File', 'value' => $filename],
        ];

        $viewer = new LaravelFileViewer();
        return $viewer->show($filename, $filepath, $file_url, $file_data);
    }

    public function previewTransparansiAnggaran($filename)
    {
        $relativePath = 'assets/documents/transparansiAnggaran/' . $filename;
        $filepath = 'public/' . $relativePath;
        $file_url = asset('storage/' . $relativePath);

        if (!Storage::exists($filepath)) {
            abort(404, 'File tidak ditemukan');
        }

        $file_data = [
            ['label' => 'Nama File', 'value' => $filename],
        ];

        $viewer = new LaravelFileViewer();
        return $viewer->show($filename, $filepath, $file_url, $file_data);
    }

    public function dataLaporanKegiatan()
    {
        $laporanKegiatan = LaporanKegiatan::where('status', 'Publish')
            ->orderBy('tanggal_kegiatan', 'desc')
            ->paginate(6);

        return view('transparansi.laporan-kegiatan', compact('laporanKegiatan'));
    }

    public function previewLaporanKegiatan($filename)
    {
        $relativePath = 'assets/documents/laporanKegiatan/' . $filename;
        $filepath = 'public/' . $relativePath;
        $file_url = asset('storage/' . $relativePath);

        if (!Storage::exists($filepath)) {
            abort(404, 'File tidak ditemukan');
        }

        $file_data = [
            ['label' => 'Nama File', 'value' => $filename],
        ];

        $viewer = new LaravelFileViewer();
        return $viewer->show($filename, $filepath, $file_url, $file_data);
    }

    public function showDataPemerintahan()
    {
        $pemerintahans = LayananPemerintahan::where('status', 'Publish')->get();
        return view('pelayanan.layanan-pemerintahan', compact('pemerintahans'));
    }

    public function showDataLayananPemerintahan($id)
    {
        $pemerintahan = LayananPemerintahan::findOrFail($id);
        return response()->json(['deskripsi' => $pemerintahan->deskripsi]);
    }

    public function showDataPelayanan()
    {
        $pelayanans = LayananPelayanan::where('status', 'Publish')->get();
        return view('pelayanan.layanan-pelayanan', compact('pelayanans'));
    }

    public function showDataLayananPelayanan($id)
    {
        $pelayanan = LayananPelayanan::findOrFail($id);
        return response()->json(['deskripsi' => $pelayanan->deskripsi]);
    }

    public function showDataPosyandu()
    {
        $posyandus = LayananPosyandu::where('status', 'Publish')->get();
        return view('pelayanan.layanan-posyandu', compact('posyandus'));
    }

    public function showDataLayananPosyandu($id)
    {
        $posyandu = LayananPosyandu::findOrFail($id);
        return response()->json([
            'nama_pelayanan' => $posyandu->nama_pelayanan,
            'kategori' => $posyandu->kategori,
            'tanggal_pelayanan' => $posyandu->tanggal_pelayanan,
            'jam_mulai' => $posyandu->jam_mulai,
            'jam_selesai' => $posyandu->jam_selesai
        ]);
    }

    public function showdataKesra()
    {
        $layananKesra = LayananKesra::where('status', 'Publish')
            ->orderBy('tahun', 'desc')
            ->orderByDesc('created_at')
            ->get();
        return view('pelayanan.layanan-kesra', compact('layananKesra'));
    }

    public function showDataLayananKesra($id)
    {
        $layananKesra = LayananKesra::findOrFail($id);
        return response()->json([
            'deskripsi' => $layananKesra->deskripsi,
            'file_dokumen' => $layananKesra->file_dokumen
        ]);
    }

    public function showDataKaryawanPemdes()
    {
        $karyawans = Karyawan::select('nama', 'jabatan', 'jenis_kelamin', 'foto')->get();
        return view('struktur.pemdes', compact('karyawans'));
    }

    public function downloadLaporanKegiatan($filename)
    {
        $path = storage_path('app/public/assets/documents/laporanKegiatan/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->download($path);
    }
    public function downloadTransparansiAnggaran($filename)
    {
        $path = storage_path('app/public/assets/documents/transparansiAnggaran/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->download($path);
    }
    public function downloadDokumenPublik($filename)
    {
        $path = storage_path('app/public/assets/documents/dokumenPublik/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->download($path);
    }
    public function downloadDokumenPelayananKesra($filename)
    {
        $path = storage_path('app/public/assets/documents/layananKesra/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->download($path);
    }

    public function dataTranparansiBumdes()
    {
        $transparansiBumdes = TransparansiBumdes::where('status', 'Publish')
            ->orderBy('tahun', 'desc')
            ->paginate(6);
        return view('transparansi.transparansi-bumdes', compact('transparansiBumdes'));
    }

    public function previewTransparansiBumdes($filename)
    {
        $relativePath = 'assets/documents/transparansiBumdes/' . $filename;
        $filepath = 'public/' . $relativePath;
        $file_url = asset('storage/' . $relativePath);

        if (!Storage::exists($filepath)) {
            abort(404, 'File tidak ditemukan');
        }

        $file_data = [
            ['label' => 'Nama File', 'value' => $filename],
        ];

        $viewer = new LaravelFileViewer();
        return $viewer->show($filename, $filepath, $file_url, $file_data);
    }

    public function downloadTransparansiBumdes($filename)
    {
        $path = storage_path('app/public/assets/documents/transparansiBumdes/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->download($path);
    }
}
