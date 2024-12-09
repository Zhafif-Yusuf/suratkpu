<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SuratMasukController extends Controller
{
    // Menampilkan daftar surat masuk
    public function index()
    {
        // Get surat masuk for the authenticated user
        $suratMasuk = SuratMasuk::where('user_id', auth()->user()->id)->get();

        // Count total surat masuk
        $jumlahSuratMasuk = SuratMasuk::count(); // Total surat masuk count

        // Return view with surat masuk and count
        return view('suratmasuk.index', compact('suratMasuk', 'jumlahSuratMasuk'));
    }

    // Menampilkan form tambah surat masuk
    public function create()
    {
        return view('suratmasuk.create');
    }

    // Menyimpan data surat masuk
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
            $namaFile = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('suratmasuk_files', $namaFile, 'public');
        }

        // Menyimpan data surat masuk ke database dengan user_id
        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'perihal_surat' => $request->perihal_surat,
            'file' => $filePath ?? null, // Menyimpan path file
            'nama_file' => $namaFile ?? null, // Menyimpan nama file asli
            'user_id' => auth()->user()->id, // Menambahkan user_id saat menyimpan
        ]);

        return redirect()->route('suratmasuk.index');
    }

    // Menampilkan form untuk edit surat masuk
    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id); // Ambil data surat berdasarkan ID
        return view('suratmasuk.edit', compact('surat'));
    }

    // Fungsi untuk mengupdate data surat masuk
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

        return redirect()->route('suratmasuk.index');
    }

    // Menghapus surat masuk
    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        // Hapus file terkait jika ada
        if ($suratMasuk->file) {
            Storage::disk('public')->delete($suratMasuk->file);
        }

        // Hapus data surat masuk
        $suratMasuk->delete();

        return redirect()->route('suratmasuk.index');
    }

    // Dashboard untuk jumlah surat masuk
    public function dashboard()
    {
        // Menghitung jumlah surat masuk bulan ini
        $jumlahSuratMasukBulanIni = SuratMasuk::whereMonth('tanggal_surat', Carbon::now()->month)
                                                ->whereYear('tanggal_surat', Carbon::now()->year)
                                                ->count();
        
        // Menghitung jumlah surat masuk
        $jumlahSuratMasuk = SuratMasuk::count();
        
        // Menghitung jumlah surat masuk tahun ini
        $jumlahSuratMasukTahunIni = SuratMasuk::whereYear('tanggal_surat', Carbon::now()->year)
                                                ->count();

        return view('dashboard', compact('jumlahSuratMasuk', 'jumlahSuratMasukBulanIni', 'jumlahSuratMasukTahunIni'));
    }

    // Pencarian surat masuk
    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $suratMasuk = SuratMasuk::query()
            ->where('nomor_surat', 'like', "%{$keyword}%")
            ->orWhere('tanggal_surat', 'like', "%{$keyword}%")
            ->orWhere('tujuan_surat', 'like', "%{$keyword}%")
            ->orWhere('perihal_surat', 'like', "%{$keyword}%")
            ->orWhere('nama_file', 'like', "%{$keyword}%")  // Menambahkan pencarian berdasarkan nama file
            ->orderBy('created_at', 'desc')
            ->get();

        return view('suratmasuk.index', compact('suratMasuk', 'keyword'));
    }
}
