<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\ServiceProvider;
use App\Models\TransportRoute;
use App\Models\Accommodation;
use App\Models\Attraction;
use App\Models\Promotion;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data untuk ditampilkan di dashboard
        $data = [
            'cities' => City::all(),
            'providers' => ServiceProvider::all(),
            'routes' => TransportRoute::with(['originCity', 'destinationCity', 'serviceProvider'])->get(),
            'accommodations' => Accommodation::with(['city', 'serviceProvider'])->get(),
            'attractions' => Attraction::with('city')->get(),
            'promotions' => Promotion::all(),
        ];
        
        return view('admin.dashboard', $data);
    }

    // --- FUNGSI MENAMBAH DATA (CONTOH SIMPEL) ---
    
    public function storeCity(Request $request) {
        City::create($request->all());
        return back()->with('success', 'Kota berhasil ditambahkan!');
    }

    public function storeProvider(Request $request) {
        ServiceProvider::create($request->all());
        return back()->with('success', 'Provider berhasil ditambahkan!');
    }

    public function storeRoute(Request $request) {
        // Pastikan fasilitas di-encode jadi JSON sebelum simpan
        $data = $request->all();
        $data['facilities'] = json_encode($request->facilities ?? []);
        TransportRoute::create($data);
        return back()->with('success', 'Rute berhasil ditambahkan!');
    }

    public function storeAccommodation(Request $request) {
        $data = $request->all();
        $data['facilities'] = json_encode($request->facilities ?? []);
        Accommodation::create($data);
        return back()->with('success', 'Akomodasi berhasil ditambahkan!');
    }

    public function storeAttraction(Request $request) {
        Attraction::create($request->all());
        return back()->with('success', 'Wisata berhasil ditambahkan!');
    }
    
    public function storePromotion(Request $request) {
        Promotion::create($request->all());
        return back()->with('success', 'Promo berhasil ditambahkan!');
    }
}