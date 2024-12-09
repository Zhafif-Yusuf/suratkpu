<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SuratKeluarController extends Controller
{
    // Menampilkan daftar surat keluar
    public function index()
    {
        // Ambil semua data surat keluar berdasarkan user yang sedang login
        $suratKeluar = SuratKeluar::where('user_id', auth()->id())->get(); 
    
        // Hitung jumlah surat keluar berdasarkan user yang sedang login
        $jumlahSuratKeluar = SuratKeluar::where('user_id', auth()->id())->count(); 
    
        return view('suratkeluar.index', compact('suratKeluar', 'jumlahSuratKeluar'));
    }
    
    public function dashboard()
{
    // Menghitung jumlah surat keluar tahun ini
    $jumlahSuratKeluarTahunIni = SuratKeluar::whereYear('tanggal_surat', Carbon::now()->year)
        ->count(); // Menghitung surat keluar tahun ini

    // Mengirimkan data ke view dashboard
    return view('dashboard', compact('jumlahSuratKeluarTahunIni'));
}

    
    // Menampilkan form tambah surat keluar
    public function create()
    {
        return view('suratkeluar.create'); // Form untuk menambah surat keluar
    }

    // Menyimpan data surat keluar
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tujuan_surat' => 'required|string|max:255',
            'perihal_surat' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,jpg,png|max:102400', // 'nullable' instead of 'required'
        ]);

        // Menyimpan file jika ada
        $filePath = null; // Default filePath to null
        $namaFile = null;  // Default file name to null

        if ($request->hasFile('file')) {
            // Mendapatkan nama asli file
            $namaFile = $request->file('file')->getClientOriginalName();
            
            // Menyimpan file dan mendapatkan path
            $filePath = $request->file('file')->storeAs('suratkeluar_files', $namaFile, 'public');
        }

        // Menyimpan data surat keluar ke database
        SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'perihal_surat' => $request->perihal_surat,
            'file' => $filePath,  // If no file, filePath will remain null
            'nama_file' => $filePath ? $namaFile : null,  // Set 'nama_file' only if file exists
            'user_id' => auth()->id(),  // Assign the authenticated user's ID
        ]);

        return redirect()->route('suratkeluar.index');
    }

    // Menampilkan form untuk mengedit surat keluar
    public function edit($id)
    {
        $surat = SuratKeluar::findOrFail($id); // Mengambil data surat keluar berdasarkan ID
        return view('suratkeluar.edit', compact('surat')); // Pass data ke view edit
    }

    // Fungsi untuk mengupdate data surat keluar
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tujuan_surat' => 'required|string|max:255',
            'perihal_surat' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,jpg,png|max:2048', // Opsional jika file ingin diganti
        ]);

        $surat = SuratKeluar::findOrFail($id); // Mendapatkan data surat keluar yang ingin diupdate

        // Menyimpan file baru jika ada
        $filePath = $surat->file;
        $namaFile = $surat->nama_file;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            Storage::disk('public')->delete($surat->file);

            // Menyimpan file baru dan mendapatkan pathnya
            $filePath = $request->file('file')->store('suratkeluar_files', 'public');
            $namaFile = $request->file('file')->getClientOriginalName();
        }

        // Update data surat keluar
        $surat->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'perihal_surat' => $request->perihal_surat,
            'file' => $filePath,
            'nama_file' => $namaFile,
            'user_id' => auth()->id(),  // Ensure user_id is updated
        ]);

        // Redirect ke halaman daftar surat keluar
        return redirect()->route('suratkeluar.index')->with('success', 'Surat keluar berhasil diperbarui!');
    }

    // Menghapus surat keluar
    public function destroy($id)
    {
        // Mencari data surat keluar berdasarkan ID
        $suratKeluar = SuratKeluar::findOrFail($id);

        // Hapus file yang terkait jika ada
        if ($suratKeluar->file) {
            Storage::disk('public')->delete($suratKeluar->file);
        }

        // Hapus data dari database
        $suratKeluar->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('suratkeluar.index')->with('success', 'Surat keluar berhasil dihapus!');
    }

    // Dashboard untuk melihat statistik surat keluar
    public function dashboard()
    {
        // Menghitung jumlah surat keluar bulan ini
        $jumlahSuratKeluarBulanIni = SuratKeluar::whereMonth('tanggal_surat', Carbon::now()->month)
            ->whereYear('tanggal_surat', Carbon::now()->year)
            ->count(); // Menghitung surat keluar bulan ini

        // Menghitung jumlah surat keluar
        $jumlahSuratKeluar = SuratKeluar::count(); // Menghitung semua surat keluar

        // Menghitung jumlah surat keluar tahun ini
        $jumlahSuratKeluarTahunIni = SuratKeluar::whereYear('tanggal_surat', Carbon::now()->year)
            ->count(); // Menghitung surat keluar tahun ini

        // Mengirimkan data ke view dashboard
        return view('dashboard', compact('jumlahSuratKeluar', 'jumlahSuratKeluarBulanIni', 'jumlahSuratKeluarTahunIni'));
    }

    // Fungsi pencarian surat keluar
    public function search(Request $request)
    {
        $keyword = $request->input('search');

        // Query pencarian
        $suratKeluar = SuratKeluar::query()
            ->where('nomor_surat', 'like', "%{$keyword}%")
            ->orWhere('tanggal_surat', 'like', "%{$keyword}%")
            ->orWhere('tujuan_surat', 'like', "%{$keyword}%")
            ->orWhere('perihal_surat', 'like', "%{$keyword}%")
            ->orWhere('nama_file', 'like', "%{$keyword}%") // Menambahkan pencarian berdasarkan nama file
            ->orderBy('created_at', 'desc')
            ->get();

        // Kembali ke view dengan data hasil pencarian
        return view('suratkeluar.index', compact('suratKeluar', 'keyword'));
    }

    // Menampilkan file surat keluar untuk diunduh
    public function show($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return response()->download(storage_path('app/public/' . $surat->file), $surat->nama_file);
    }
}
