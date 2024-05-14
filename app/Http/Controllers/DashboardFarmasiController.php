<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardFarmasiController extends Controller
{
    public function index()
    {
        // Daftar menu dengan tautan dinamis
        $menuItems = [
            'Farmasi' => 'farmasi',
            'Obat' => 'obat',
            'Pasien' => 'pasien',
            'Rekam Medis' => 'rekam-medis',
            'Tindakan' => 'tindakan'
        ];

        // Memuat tampilan dashboard farmasi dengan data menuItems
        return view('index')->with('menuItems', $menuItems);
    }

    

    public function showPage($page)
    {
        
        $menuItems = [
            'Farmasi' => 'farmasi',
            'Obat' => 'obat',
            'Pasien' => 'pasien',
            'Rekam Medis' => 'rekam-medis',
            'Tindakan' => 'tindakan'
        ];

        // Memeriksa apakah halaman yang diminta termasuk dalam daftar halaman yang diizinkan
        $allowedPages = ['farmasi', 'obat', 'pasien', 'rekam-medis', 'tindakan'];

        if (in_array($page, $allowedPages)) {
            // Memuat tampilan yang sesuai (misalnya, farmasi.blade.php, obat.blade.php, dsb.)
            return view($page)->with('menuItems', $menuItems);
        } else {
            // Halaman tidak ditemukan, redirect ke halaman dashboard farmasi
            return redirect()->route('dashboard.farmasi');
        }
    }
    public function goToFarmasiView()
    {
        return view('farmasi');
    }

    public function adminFarmasi()
    {
        return view('adminFarmasi');
    }

    
    public function userFarmasi()
    {
        return view('userFarmasi');
    }
    

}
