<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\ServiceProvider;
use App\Models\TransportRoute;
use App\Models\Accommodation;
use App\Models\Attraction;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data untuk ditampilkan di dashboard
        $data = [
            'cities' => City::all(),
            'providers' => ServiceProvider::all(),
            
            // Paginate agar halaman tidak berat
            'routes' => TransportRoute::with(['originCity', 'destinationCity', 'serviceProvider'])
                        ->latest()
                        ->paginate(10, ['*'], 'routes_page'),
            
            'accommodations' => Accommodation::with(['city', 'serviceProvider'])
                        ->latest()
                        ->paginate(10, ['*'], 'accommodations_page'),
            
            'attractions' => Attraction::with('city')
                        ->latest()
                        ->paginate(10, ['*'], 'attractions_page'),
        ];
        
        return view('admin.dashboard', $data);
    }

    // --- STORE (TAMBAH DATA) ---
    
    public function storeCity(Request $request) {
        City::create($request->all());
        return back()->with('success', 'Kota berhasil ditambahkan!');
    }

    public function storeProvider(Request $request) {
        ServiceProvider::create($request->all());
        return back()->with('success', 'Provider berhasil ditambahkan!');
    }

    public function storeRoute(Request $request) {
        $data = $request->all();
        
        // Logika Khusus Budgettrip (ID 99)
        if($request->providerID == 99) {
            $data['bookingLink'] = null;
        }

        $data['facilities'] = json_encode($request->facilities ?? []);
        TransportRoute::create($data);
        return back()->with('success', 'Rute berhasil ditambahkan!');
    }

    public function storeAccommodation(Request $request) {
        $data = $request->all();
        
        // Logika Khusus Budgettrip Hotel (ID 100)
        if($request->providerID == 100) {
            $data['bookingLink'] = null;
        }

        $data['facilities'] = json_encode($request->facilities ?? []);
        Accommodation::create($data);
        return back()->with('success', 'Akomodasi berhasil ditambahkan!');
    }

    public function storeAttraction(Request $request) {
        $data = $request->all();
        if($request->has('images') && !empty($request->images)) {
            $data['images'] = json_encode([$request->images]); // Simpan sebagai array JSON ["url"]
        }
        
        Attraction::create($data);
        return back()->with('success', 'Wisata berhasil ditambahkan!');
    }
    
    // --- UPDATE (EDIT DATA) ---
    public function updateCity(Request $request, $id) {
        $item = City::where('cityID', $id)->firstOrFail();
        $item->update($request->all());
        return back()->with('success', 'Kota berhasil diperbarui!');
    }

    public function updateProvider(Request $request, $id) {
        $item = ServiceProvider::where('providerID', $id)->firstOrFail();
        $item->update($request->all());
        return back()->with('success', 'Provider berhasil diperbarui!');
    }

    public function updateRoute(Request $request, $id) {
        $item = TransportRoute::where('routeID', $id)->firstOrFail();
        $data = $request->all();

        if($request->providerID == 99) {
            $data['bookingLink'] = null;
        }
        
        if($request->has('facilities')) {
            $data['facilities'] = json_encode($request->facilities);
        } else {
            $data['facilities'] = json_encode([]); 
        }
        $item->update($data);
        return back()->with('success', 'Rute berhasil diperbarui!');
    }

    public function updateAccommodation(Request $request, $id) {
        $item = Accommodation::where('accommodationID', $id)->firstOrFail();
        $data = $request->all();

        if($request->providerID == 100) {
            $data['bookingLink'] = null;
        }

        if($request->has('facilities')) {
            $data['facilities'] = json_encode($request->facilities);
        } else {
            $data['facilities'] = json_encode([]);
        }
        $item->update($data);
        return back()->with('success', 'Akomodasi berhasil diperbarui!');
    }

    public function updateAttraction(Request $request, $id) {
        $item = Attraction::where('attractionID', $id)->firstOrFail();
        $data = $request->all();

        if($request->has('images') && !empty($request->images)) {
             $data['images'] = json_encode([$request->images]);
        }

        $item->update($data);
        return back()->with('success', 'Wisata berhasil diperbarui!');
    }

    // --- DESTROY (HAPUS DATA) ---

    public function destroyCity($id) {
        $item = City::where('cityID', $id)->firstOrFail();
        $item->delete();
        return back()->with('success', 'Kota berhasil dihapus!');
    }

    public function destroyProvider($id) {
        $item = ServiceProvider::where('providerID', $id)->firstOrFail();
        $item->delete();
        return back()->with('success', 'Provider berhasil dihapus!');
    }

    public function destroyRoute($id) {
        $item = TransportRoute::where('routeID', $id)->firstOrFail();
        $item->delete();
        return back()->with('success', 'Rute berhasil dihapus!');
    }

    public function destroyAccommodation($id) {
        $item = Accommodation::where('accommodationID', $id)->firstOrFail();
        $item->delete();
        return back()->with('success', 'Akomodasi berhasil dihapus!');
    }

    public function destroyAttraction($id) {
        $item = Attraction::where('attractionID', $id)->firstOrFail();
        $item->delete();
        return back()->with('success', 'Wisata berhasil dihapus!');
    }
}