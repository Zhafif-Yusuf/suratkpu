<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class SuratKeluarController extends Controller
{
    // Menampilkan daftar surat keluar
    public function index()
    {
        $suratKeluar = SuratKeluar::all(); // Mengambil semua data surat keluar
        return view('suratkeluar.index', compact('suratKeluar')); // Menampilkan daftar surat keluar
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
        'file' => 'required|file|mimes:pdf,docx,jpg,png|max:102400', // Sesuaikan dengan jenis file yang diterima
    ]);

    // Menyimpan file jika ada
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
        'file' => $filePath ?? null, // Menyimpan path file
        'nama_file' => $namaFile ?? null, // Menyimpan nama file asli
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
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            Storage::disk('public')->delete($surat->file);

            // Menyimpan file baru dan mendapatkan pathnya
            $filePath = $request->file('file')->store('suratkeluar_files', 'public');
            $namaFile = $request->file('file')->getClientOriginalName();
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $filePath = $surat->file;
            $namaFile = $surat->nama_file;
        }

        // Update data surat keluar
        $surat->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'perihal_surat' => $request->perihal_surat,
            'file' => $filePath,
            'nama_file' => $namaFile,
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
        return redirect()->route('suratkeluar.index');
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
    public function show($id)
{
    $surat = SuratKeluar::findOrFail($id);
    return response()->download(storage_path('app/public/' . $surat->file), $surat->nama_file);
}

}
