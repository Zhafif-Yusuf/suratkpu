<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Data Surat Masuk
        $jumlahSuratMasukBulanIni = SuratMasuk::whereMonth('tanggal_surat', Carbon::now()->month)
            ->whereYear('tanggal_surat', Carbon::now()->year)
            ->count();
        $jumlahSuratMasuk = SuratMasuk::count();
        $jumlahSuratMasukTahunIni = SuratMasuk::whereYear('tanggal_surat', Carbon::now()->year)
            ->count();

        // Data Surat Keluar
        $jumlahSuratKeluarBulanIni = SuratKeluar::whereMonth('tanggal_surat', Carbon::now()->month)
            ->whereYear('tanggal_surat', Carbon::now()->year)
            ->count();
        $jumlahSuratKeluar = SuratKeluar::count();
        $jumlahSuratKeluarTahunIni = SuratKeluar::whereYear('tanggal_surat', Carbon::now()->year)
            ->count();

        // Data Surat Masuk per Tahun (2020-2024)
        $suratMasukPerTahun = [
            '2020' => SuratMasuk::whereYear('tanggal_surat', 2020)->count(),
            '2021' => SuratMasuk::whereYear('tanggal_surat', 2021)->count(),
            '2022' => SuratMasuk::whereYear('tanggal_surat', 2022)->count(),
            '2023' => SuratMasuk::whereYear('tanggal_surat', 2023)->count(),
            '2024' => SuratMasuk::whereYear('tanggal_surat', 2024)->count(),
        ];

        // Data Surat Masuk per Minggu
        $startMinggu1 = Carbon::now()->startOfMonth()->addWeeks(0);
        $endMinggu1 = Carbon::now()->startOfMonth()->addWeeks(1);
        $startMinggu2 = Carbon::now()->startOfMonth()->addWeeks(1);
        $endMinggu2 = Carbon::now()->startOfMonth()->addWeeks(2);
        $startMinggu3 = Carbon::now()->startOfMonth()->addWeeks(2);
        $endMinggu3 = Carbon::now()->startOfMonth()->addWeeks(3);
        $startMinggu4 = Carbon::now()->startOfMonth()->addWeeks(3);
        $endMinggu4 = Carbon::now()->startOfMonth()->addWeeks(4);

        $suratMasukPerMinggu = [
            'Minggu1' => SuratMasuk::whereBetween('tanggal_surat', [$startMinggu1, $endMinggu1])->count(),
            'Minggu2' => SuratMasuk::whereBetween('tanggal_surat', [$startMinggu2, $endMinggu2])->count(),
            'Minggu3' => SuratMasuk::whereBetween('tanggal_surat', [$startMinggu3, $endMinggu3])->count(),
            'Minggu4' => SuratMasuk::whereBetween('tanggal_surat', [$startMinggu4, $endMinggu4])->count(),
        ];

        // Data Surat Masuk per Bulan (Januari-Desember)
        $suratMasukPerBulan = [
            'Januari' => SuratMasuk::whereMonth('tanggal_surat', 1)->count(),
            'Februari' => SuratMasuk::whereMonth('tanggal_surat', 2)->count(),
            'Maret' => SuratMasuk::whereMonth('tanggal_surat', 3)->count(),
            'April' => SuratMasuk::whereMonth('tanggal_surat', 4)->count(),
            'Mei' => SuratMasuk::whereMonth('tanggal_surat', 5)->count(),
            'Juni' => SuratMasuk::whereMonth('tanggal_surat', 6)->count(),
            'Juli' => SuratMasuk::whereMonth('tanggal_surat', 7)->count(),
            'Agustus' => SuratMasuk::whereMonth('tanggal_surat', 8)->count(),
            'September' => SuratMasuk::whereMonth('tanggal_surat', 9)->count(),
            'Oktober' => SuratMasuk::whereMonth('tanggal_surat', 10)->count(),
            'November' => SuratMasuk::whereMonth('tanggal_surat', 11)->count(),
            'Desember' => SuratMasuk::whereMonth('tanggal_surat', 12)->count(),
        ];

        // Kirim data ke view
        return view('dashboard', compact(
            'jumlahSuratMasuk',
            'jumlahSuratMasukBulanIni',
            'jumlahSuratMasukTahunIni',
            'jumlahSuratKeluar',
            'jumlahSuratKeluarBulanIni',
            'jumlahSuratKeluarTahunIni',
            'suratMasukPerTahun',
            'suratMasukPerMinggu',
            'suratMasukPerBulan'
        ));
    }
}
