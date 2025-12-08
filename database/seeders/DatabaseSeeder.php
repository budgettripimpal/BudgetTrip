<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. USERS (Admin & User Dummy)
        // ==========================================
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Fajril Ikhsan',
                'email' => 'fajril@example.com',
                'password' => Hash::make('password'),
                'phoneNumber' => '081234567890',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Damar Wahyu',
                'email' => 'damar@example.com',
                'password' => Hash::make('password'),
                'phoneNumber' => '081234567891',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 99,
                'name' => 'Admin BudgetTrip',
                'email' => 'admin@budgettrip.com',
                'password' => Hash::make('password'),
                'phoneNumber' => '081234567899',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // ==========================================
        // 2. CITIES (Kota-kota Besar di Indonesia)
        // ==========================================
        $cities = [
            ['id' => 1, 'name' => 'Bandung', 'prov' => 'Jawa Barat', 'lat' => -6.917464, 'lng' => 107.619123],
            ['id' => 2, 'name' => 'Jakarta', 'prov' => 'DKI Jakarta', 'lat' => -6.208763, 'lng' => 106.845599],
            ['id' => 3, 'name' => 'Yogyakarta', 'prov' => 'DIY', 'lat' => -7.795580, 'lng' => 110.369490],
            ['id' => 4, 'name' => 'Surabaya', 'prov' => 'Jawa Timur', 'lat' => -7.257472, 'lng' => 112.752088],
            ['id' => 5, 'name' => 'Bali (Denpasar)', 'prov' => 'Bali', 'lat' => -8.670458, 'lng' => 115.212629],
            ['id' => 6, 'name' => 'Malang', 'prov' => 'Jawa Timur', 'lat' => -7.966620, 'lng' => 112.632632],
            ['id' => 7, 'name' => 'Semarang', 'prov' => 'Jawa Tengah', 'lat' => -6.966667, 'lng' => 110.416664],
            ['id' => 8, 'name' => 'Medan', 'prov' => 'Sumatera Utara', 'lat' => 3.595196, 'lng' => 98.672223],
            ['id' => 9, 'name' => 'Palembang', 'prov' => 'Sumatera Selatan', 'lat' => -2.976074, 'lng' => 104.775431],
            ['id' => 10, 'name' => 'Labuan Bajo', 'prov' => 'NTT', 'lat' => -8.453483, 'lng' => 119.873278],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'cityID' => $city['id'],
                'cityName' => $city['name'],
                'province' => $city['prov'],
                'locationType' => 'Kota',
                'latitude' => $city['lat'],
                'longitude' => $city['lng'],
            ]);
        }

        // ==========================================
        // 3. SERVICE PROVIDERS
        // ==========================================
        $providers = [
            ['id' => 1, 'name' => 'Cititrans', 'type' => 'Transportasi'], // Travel
            ['id' => 2, 'name' => 'DayTrans', 'type' => 'Transportasi'], // Travel
            ['id' => 3, 'name' => 'Sinar Jaya', 'type' => 'Transportasi'], // Bus
            ['id' => 4, 'name' => 'Rosalia Indah', 'type' => 'Transportasi'], // Bus
            ['id' => 5, 'name' => 'KAI (Kereta Api)', 'type' => 'Transportasi'], // Kereta
            ['id' => 6, 'name' => 'Garuda Indonesia', 'type' => 'Transportasi'], // Pesawat
            ['id' => 7, 'name' => 'Lion Air', 'type' => 'Transportasi'], // Pesawat
            ['id' => 8, 'name' => 'Pelni', 'type' => 'Transportasi'], // Kapal
            ['id' => 9, 'name' => 'Traveloka', 'type' => 'Akomodasi'],
            ['id' => 10, 'name' => 'Booking.com', 'type' => 'Akomodasi'],
            ['id' => 11, 'name' => 'Tiket.com', 'type' => 'Akomodasi'],
            ['id' => 99, 'name' => 'Budgettrip Travel', 'type' => 'Transportasi'], // Custom
            ['id' => 100, 'name' => 'Budgettrip Hotel', 'type' => 'Akomodasi'], // Custom
        ];

        foreach ($providers as $p) {
            DB::table('service_providers')->insert([
                'providerID' => $p['id'],
                'providerName' => $p['name'],
                'serviceType' => $p['type'],
            ]);
        }

        // ==========================================
        // 4. ACCOMMODATIONS (Setiap Kota Ada)
        // ==========================================
        $accommodationsData = [];
        $accID = 1;

        foreach ($cities as $city) {
            // Hotel Mewah
            $accommodationsData[] = [
                'accommodationID' => $accID++,
                'providerID' => 10, // Booking.com
                'cityID' => $city['id'],
                'hotelName' => 'Grand Hotel ' . $city['name'],
                'averagePricePerNight' => rand(800000, 1500000),
                'rating' => 4.8,
                'type' => 'Hotel',
                'facilities' => json_encode(['Kolam Renang', 'Gym', 'Spa', 'Breakfast']),
                'bookingLink' => 'https://booking.com/grand-' . strtolower(str_replace(' ', '-', $city['name'])),
                'description' => 'Hotel bintang 5 dengan pemandangan pusat kota ' . $city['name'],
                'images' => json_encode(['https://placehold.co/600x400?text=Grand+Hotel+' . urlencode($city['name'])]),
                'latitude' => $city['lat'] + 0.002, // Sedikit geser dari pusat kota
                'longitude' => $city['lng'] + 0.002,
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Hotel Budget (Budgettrip)
            $accommodationsData[] = [
                'accommodationID' => $accID++,
                'providerID' => 100, // Budgettrip Hotel
                'cityID' => $city['id'],
                'hotelName' => 'Budgettrip Capsule ' . $city['name'],
                'averagePricePerNight' => rand(100000, 250000),
                'rating' => 4.2,
                'type' => 'Hostel',
                'facilities' => json_encode(['WiFi', 'AC', 'Loker', 'Shared Bathroom']),
                'bookingLink' => null, // Bisa bayar langsung di app
                'description' => 'Penginapan hemat dan nyaman untuk backpacker di ' . $city['name'],
                'images' => json_encode(['https://placehold.co/600x400?text=Capsule+' . urlencode($city['name'])]),
                'latitude' => $city['lat'] - 0.002,
                'longitude' => $city['lng'] - 0.002,
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Villa / Guesthouse
            $accommodationsData[] = [
                'accommodationID' => $accID++,
                'providerID' => 9, // Traveloka
                'cityID' => $city['id'],
                'hotelName' => 'Guesthouse Asri ' . $city['name'],
                'averagePricePerNight' => rand(300000, 500000),
                'rating' => 4.5,
                'type' => 'Guesthouse',
                'facilities' => json_encode(['WiFi', 'Parkir', 'Dapur']),
                'bookingLink' => 'https://traveloka.com/guesthouse-' . strtolower(str_replace(' ', '-', $city['name'])),
                'description' => 'Suasana seperti rumah sendiri di jantung kota ' . $city['name'],
                'images' => json_encode(['https://placehold.co/600x400?text=Guesthouse']),
                'latitude' => $city['lat'] + 0.005,
                'longitude' => $city['lng'] - 0.005,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('accommodations')->insert($accommodationsData);


        // ==========================================
        // 5. ATTRACTIONS (Setiap Kota Ada)
        // ==========================================
        $attractionsData = [];
        $attID = 1;
        $categories = ['Alam', 'Sejarah', 'Kuliner', 'Hiburan', 'Belanja'];

        foreach ($cities as $city) {
            // Wisata 1
            $attractionsData[] = [
                'attractionID' => $attID++,
                'cityID' => $city['id'],
                'attractionName' => 'Alun-alun ' . $city['name'],
                'category' => 'Hiburan',
                'estimatedCost' => 0,
                'rating' => 4.5,
                'reviewCount' => rand(100, 5000),
                'description' => 'Pusat keramaian kota ' . $city['name'] . ' dengan berbagai jajanan.',
                'bookingLink' => null,
                'images' => json_encode(['https://placehold.co/600x400?text=Alun-alun+' . urlencode($city['name'])]),
                'latitude' => $city['lat'],
                'longitude' => $city['lng'],
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Wisata 2 (Berbayar)
            $attractionsData[] = [
                'attractionID' => $attID++,
                'cityID' => $city['id'],
                'attractionName' => 'Museum Sejarah ' . $city['name'],
                'category' => 'Sejarah',
                'estimatedCost' => rand(15000, 50000),
                'rating' => 4.6,
                'reviewCount' => rand(50, 1000),
                'description' => 'Menyimpan benda bersejarah dari kota ' . $city['name'],
                'bookingLink' => 'https://museum.go.id',
                'images' => json_encode(['https://placehold.co/600x400?text=Museum']),
                'latitude' => $city['lat'] + 0.01,
                'longitude' => $city['lng'] + 0.01,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('attractions')->insert($attractionsData);


        // ==========================================
        // 6. TRANSPORT ROUTES (Logika Kursi Dinamis)
        // ==========================================
        $routesData = [];
        $routeID = 1;

        // Fungsi Helper untuk generate rute
        $createRoute = function ($provID, $origin, $dest, $type, $price, $time, $seats) use (&$routeID) {
            return [
                'routeID' => $routeID++,
                'providerID' => $provID,
                'originCityID' => $origin['id'],
                'destinationCityID' => $dest['id'],
                'averagePrice' => $price,
                'departureTime' => $time,
                'arrivalTime' => date('H:i:s', strtotime($time) + 3600 * rand(1, 5)), // Estimasi +1-5 jam
                'class' => ($seats == 8 ? 'Executive Shuttle' : ($seats == 28 ? 'Business Class' : 'Economy')),
                'total_seats' => $seats,
                'facilities' => json_encode(['AC', ($seats > 30 ? 'Toilet' : 'Reclining Seat')]),
                'bookingLink' => ($provID == 99 ? null : 'https://ticket.com'),
                'description' => "Perjalanan nyaman dari {$origin['name']} ke {$dest['name']}",
                'images' => json_encode(['https://placehold.co/600x400?text=Transport']),
                'start_latitude' => $origin['lat'],
                'start_longitude' => $origin['lng'],
                'end_latitude' => $dest['lat'],
                'end_longitude' => $dest['lng'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        };

        // Buat Rute Acak Antar Kota
        // Hub: Jakarta (2), Bandung (1), Surabaya (4), Bali (5)
        $hubs = [1, 2, 4, 5];

        foreach ($cities as $origin) {
            foreach ($cities as $dest) {
                if ($origin['id'] == $dest['id']) continue; // Skip kota sama

                // Rute Travel (Jarak Dekat) - Kursi 8
                // Misal: Jkt-Bdg, Bdg-Jkt, Jogja-Semarang, Surabaya-Malang
                if (
                    ($origin['id'] == 2 && $dest['id'] == 1) || ($origin['id'] == 1 && $dest['id'] == 2) ||
                    ($origin['id'] == 3 && $dest['id'] == 7) || ($origin['id'] == 4 && $dest['id'] == 6)
                ) {
                    $routesData[] = $createRoute(1, $origin, $dest, 'Transportasi', 150000, '08:00:00', 8); // Cititrans
                    $routesData[] = $createRoute(99, $origin, $dest, 'Transportasi', 135000, '10:00:00', 8); // Budgettrip Travel
                }

                // Rute Bus (Jarak Menengah) - Kursi 28
                // Jkt-Jogja, Bdg-Jogja, Sby-Bali
                if (in_array($origin['id'], $hubs) && in_array($dest['id'], $hubs)) {
                    $routesData[] = $createRoute(4, $origin, $dest, 'Transportasi', 250000, '19:00:00', 28); // Rosalia
                    $routesData[] = $createRoute(99, $origin, $dest, 'Transportasi', 200000, '20:00:00', 28); // Budgettrip Bus
                }

                // Rute Pesawat (Jarak Jauh / Seberang Pulau) - Kursi 150
                // Jkt-Medan, Jkt-Bali, Jkt-Makassar, Sby-Medan
                if (
                    ($origin['id'] == 2 && in_array($dest['id'], [5, 8, 9])) ||
                    ($origin['id'] == 4 && $dest['id'] == 8)
                ) {
                    $routesData[] = $createRoute(6, $origin, $dest, 'Transportasi', 1200000, '07:00:00', 150); // Garuda
                    $routesData[] = $createRoute(7, $origin, $dest, 'Transportasi', 800000, '13:00:00', 180); // Lion
                }

                // Rute Kereta (Jawa) - Kursi 80
                // Jkt-Sby, Bdg-Jogja, Smg-Sby
                if ($origin['id'] <= 7 && $dest['id'] <= 7) { // Kota-kota di Jawa (ID 1-7 di array cities kita)
                    $routesData[] = $createRoute(5, $origin, $dest, 'Transportasi', 450000, '08:00:00', 80); // KAI
                }
            }
        }

        DB::table('transport_routes')->insert($routesData);


        // ==========================================
        // 7. TRAVEL PLANS CONTOH
        // ==========================================
        DB::table('travel_plans')->insert([
            [
                'planID' => 1,
                'userID' => 1,
                'planName' => 'Liburan ke Bali',
                'amount' => 5000000,
                'originCityID' => 2,
                'destinationCityID' => 5,
                'accommodationCityID' => 5,
                'startDate' => '2025-12-20',
                'endDate' => '2025-12-25',
                'requestedActivities' => json_encode(['Pantai']),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('itineraries')->insert([
            ['itineraryID' => 1, 'planID' => 1, 'itineraryName' => 'Rencana Utama', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Item Contoh (Pesawat)
        // Cari route ID pesawat Jkt-Bali (kita tau ID-nya dinamis, tapi kita ambil sampel manual atau skip)
        // Agar aman, kita biarkan kosong atau insert manual jika perlu.
    }
}
