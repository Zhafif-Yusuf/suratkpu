<?php

// app/Http/Controllers/SuratController.php

// app/Http/Controllers/SuratController.php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
{
    // Fetch both surat_keluar and surat_masuk with the user relation
    $suratKeluar = SuratKeluar::with('user')->get();
    $suratMasuk = SuratMasuk::with('user')->get();

    // Return the view with both data
    return view('surat.index', compact('suratKeluar', 'suratMasuk'));
}

}
