<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class SuratMasukController extends Controller
{
    // Menampilkan daftar surat masuk
    public function index()
    {
        $suratMasuk = SuratMasuk::all(); // Misalnya Anda mengambil data dari model
        return view('suratmasuk.index', compact('suratMasuk'));
    }


    // Menampilkan form tambah surat masuk
    // app/Http/Controllers/SuratMasukController.php

    public function create()
    {
        return view('suratmasuk.create'); // Pastikan view ini ada di folder views
    }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tujuan_surat' => 'required|string|max:255',
            'perihal_surat' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,docx,jpg,png|max:102400', // Sesuaikan dengan jenis file yang diterima
        ]);
    
        // Menyimpan file jika ada
        if ($request->hasFile('file')) {
            // Mendapatkan nama asli file
            $namaFile = $request->file('file')->getClientOriginalName();
            
            // Menyimpan file dan mendapatkan path
            $filePath = $request->file('file')->storeAs('suratmasuk_files', $namaFile, 'public');
        }
    
        // Menyimpan data surat masuk ke database
        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'perihal_surat' => $request->perihal_surat,
            'file' => $filePath ?? null, // Menyimpan path file
            'nama_file' => $namaFile ?? null, // Menyimpan nama file asli
        ]);
    
        // Redirect atau memberikan response sukses
        return redirect()->route('suratmasuk.index');
    }
    

    
    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id); // Ambil data surat berdasarkan ID
        return view('suratmasuk.edit', compact('surat')); // Pass data ke view edit
    }
    // Fungsi untuk mengupdate data surat masuk
   // Menyimpan perubahan setelah edit
public function update(Request $request, $id)
{
    // Validasi data yang masuk
    $request->validate([
        'nomor_surat' => 'required|string|max:255',
        'tanggal_surat' => 'required|date',
        'tujuan_surat' => 'required|string|max:255',
        'perihal_surat' => 'required|string|max:255',
        'file' => 'nullable|file|mimes:pdf,docx,jpg,png|max:2048', // Opsional jika file ingin diganti
    ]);

    // Mendapatkan data surat yang ingin diupdate
    $surat = SuratMasuk::findOrFail($id);

    // Menyimpan file baru jika ada
    if ($request->hasFile('file')) {
        // Hapus file lama dari storage
        Storage::disk('public')->delete($surat->file);

        // Simpan file baru dan dapatkan pathnya
        $filePath = $request->file('file')->store('suratmasuk_files', 'public');
        $namaFile = $request->file('file')->getClientOriginalName();
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $filePath = $surat->file;
        $namaFile = $surat->nama_file;
    }

    // Update data surat masuk
    $surat->update([
        'nomor_surat' => $request->nomor_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'tujuan_surat' => $request->tujuan_surat,
        'perihal_surat' => $request->perihal_surat,
        'file' => $filePath,
        'nama_file' => $namaFile,
    ]);

    // Redirect ke halaman daftar surat masuk
    return redirect()->route('suratmasuk.index');
}

    // Menghapus surat masuk
    public function destroy($id)
    {
        // Cari data surat masuk berdasarkan ID
        $suratMasuk = SuratMasuk::findOrFail($id);
    
        // Hapus file yang terkait jika ada
        if ($suratMasuk->file) {
            Storage::disk('public')->delete($suratMasuk->file);
        }
    
        // Hapus data dari database
        $suratMasuk->delete();
    
        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('suratmasuk.index');
    }
    public function dashboard()
    {
        // Menghitung jumlah surat masuk bulan ini
        $jumlahSuratMasukBulanIni = SuratMasuk::whereMonth('tanggal_surat', Carbon::now()->month)
                                                ->whereYear('tanggal_surat', Carbon::now()->year)
                                                ->count(); // Menghitung surat masuk bulan ini
        
        // Menghitung jumlah surat masuk
        $jumlahSuratMasuk = SuratMasuk::count(); // Menghitung semua surat masuk
        
        // Menghitung jumlah surat masuk tahun ini
        $jumlahSuratMasukTahunIni = SuratMasuk::whereYear('tanggal_surat', Carbon::now()->year)
                                                ->count(); // Menghitung surat masuk tahun ini
    
        // Mengirimkan data ke view dashboard
        return view('dashboard', compact('jumlahSuratMasuk', 'jumlahSuratMasukBulanIni', 'jumlahSuratMasukTahunIni'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('search');
    
        // Query pencarian
        $suratMasuk = SuratMasuk::query()
            ->where('nomor_surat', 'like', "%{$keyword}%")
            ->orWhere('tanggal_surat', 'like', "%{$keyword}%")
            ->orWhere('tujuan_surat', 'like', "%{$keyword}%")
            ->orWhere('perihal_surat', 'like', "%{$keyword}%")
            ->orWhere('nama_file', 'like', "%{$keyword}%")  // Menambahkan pencarian berdasarkan nama file
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Kembali ke view dengan data hasil pencarian
        return view('suratmasuk.index', compact('suratMasuk', 'keyword'));
    }
}    
