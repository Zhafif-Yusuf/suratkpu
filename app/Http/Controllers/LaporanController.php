<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\SuratKeluar;
class LaporanController extends Controller
{
    public function index()
    {
        // Data Semua Surat
        $suratMasukSemua = SuratMasuk::all();

        // Data Surat Masuk Bulan Ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $suratMasukBulanIni = SuratMasuk::whereMonth('tanggal_surat', $currentMonth)
            ->whereYear('tanggal_surat', $currentYear)
            ->get();

        // Data Surat Masuk Tahun Ini
        $suratMasukTahunIni = SuratMasuk::whereYear('tanggal_surat', $currentYear)
            ->get();

        // Kirim data ke view
        return view('laporan.index', compact('suratMasukSemua', 'suratMasukBulanIni', 'suratMasukTahunIni'));
    }
     // Method untuk laporan surat keluar
     public function laporanSuratKeluar()
     {
         // Ambil semua data surat keluar
         $suratKeluar = SuratKeluar::all(); // Bisa ditambah filter bulan/tahun jika perlu
 
         // Ambil data surat keluar bulan ini
         $currentMonth = Carbon::now()->month;
         $currentYear = Carbon::now()->year;
         $suratKeluarBulanIni = SuratKeluar::whereMonth('tanggal_surat', $currentMonth)
                                           ->whereYear('tanggal_surat', $currentYear)
                                           ->get();
 
         // Ambil data surat keluar tahun ini
         $suratKeluarTahunIni = SuratKeluar::whereYear('tanggal_surat', $currentYear)
                                           ->get();
 
         // Kirim data ke view
         return view('laporan.suratkeluar', compact('suratKeluar', 'suratKeluarBulanIni', 'suratKeluarTahunIni'));
     }
}
