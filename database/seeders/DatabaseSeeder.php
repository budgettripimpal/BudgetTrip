<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -------------------------
        // 1) USERS
        // -------------------------
        DB::table('users')->upsert([
            ['id' => 1, 'name' => 'Fajril Ikhsan', 'email' => 'fajril@example.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567890', 'role' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Damar Wahyu', 'email' => 'damar@example.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567891', 'role' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 99, 'name' => 'Admin BudgetTrip', 'email' => 'admin@budgettrip.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567899', 'role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ], ['id']);

        // -------------------------
        // 2) CITIES (final list)
        // -------------------------
        $cities = [
            // SUMATERA
            ['id' => 15, 'name' => 'Bandar Lampung', 'prov' => 'Lampung', 'island' => 'Sumatera', 'lat' => -5.3971, 'lng' => 105.2668],
            ['id' => 16, 'name' => 'Bakauheni', 'prov' => 'Lampung', 'island' => 'Sumatera', 'lat' => -5.87, 'lng' => 105.75],
            ['id' => 10, 'name' => 'Medan', 'prov' => 'Sumatera Utara', 'island' => 'Sumatera', 'lat' => 3.5952, 'lng' => 98.6722],
            ['id' => 12, 'name' => 'Padang', 'prov' => 'Sumatera Barat', 'island' => 'Sumatera', 'lat' => -0.9471, 'lng' => 100.4172],
            ['id' => 14, 'name' => 'Palembang', 'prov' => 'Sumatera Selatan', 'island' => 'Sumatera', 'lat' => -2.9761, 'lng' => 104.7754],
            ['id' => 11, 'name' => 'Pekanbaru', 'prov' => 'Riau', 'island' => 'Sumatera', 'lat' => 0.5071, 'lng' => 101.4478],
            ['id' => 13, 'name' => 'Jambi', 'prov' => 'Jambi', 'island' => 'Sumatera', 'lat' => -1.6101, 'lng' => 103.6131],

            // JAWA
            ['id' => 25, 'name' => 'Bandung', 'prov' => 'Jawa Barat', 'island' => 'Jawa', 'lat' => -6.9175, 'lng' => 107.6191],
            ['id' => 30, 'name' => 'Banyuwangi', 'prov' => 'Jawa Timur', 'island' => 'Jawa', 'lat' => -8.2192, 'lng' => 114.3691],
            ['id' => 23, 'name' => 'Bekasi', 'prov' => 'Jawa Barat', 'island' => 'Jawa', 'lat' => -6.2383, 'lng' => 106.9756],
            ['id' => 24, 'name' => 'Bogor', 'prov' => 'Jawa Barat', 'island' => 'Jawa', 'lat' => -6.5971, 'lng' => 106.8060],
            ['id' => 26, 'name' => 'Cirebon', 'prov' => 'Jawa Barat', 'island' => 'Jawa', 'lat' => -6.7320, 'lng' => 108.5523],
            ['id' => 22, 'name' => 'Jakarta', 'prov' => 'DKI Jakarta', 'island' => 'Jawa', 'lat' => -6.2088, 'lng' => 106.8456],
            ['id' => 20, 'name' => 'Merak (Cilegon)', 'prov' => 'Banten', 'island' => 'Jawa', 'lat' => -5.93, 'lng' => 106.00],
            ['id' => 27, 'name' => 'Yogyakarta', 'prov' => 'DIY', 'island' => 'Jawa', 'lat' => -7.7956, 'lng' => 110.3695],
            ['id' => 28, 'name' => 'Surabaya', 'prov' => 'Jawa Timur', 'island' => 'Jawa', 'lat' => -7.2575, 'lng' => 112.7521],
            ['id' => 29, 'name' => 'Sidoarjo', 'prov' => 'Jawa Timur', 'island' => 'Jawa', 'lat' => -7.4478, 'lng' => 112.7183],
            ['id' => 21, 'name' => 'Tangerang', 'prov' => 'Banten', 'island' => 'Jawa', 'lat' => -6.1783, 'lng' => 106.6319],

            // BALI
            ['id' => 41, 'name' => 'Denpasar (Bali)', 'prov' => 'Bali', 'island' => 'Bali', 'lat' => -8.6705, 'lng' => 115.2126],
            ['id' => 40, 'name' => 'Gilimanuk', 'prov' => 'Bali', 'island' => 'Bali', 'lat' => -8.1561, 'lng' => 114.4373],

            // BANDARA / STUBS
            ['id' => 90, 'name' => 'Deli Serdang (KNO)', 'prov' => 'Sumut', 'island' => 'Sumatera', 'lat' => 3.6422, 'lng' => 98.8852],
            ['id' => 91, 'name' => 'Kulon Progo (YIA)', 'prov' => 'DIY', 'island' => 'Jawa', 'lat' => -7.9042, 'lng' => 110.0631],
        ];

        foreach ($cities as $c) {
            DB::table('cities')->upsert([
                'cityID' => $c['id'],
                'cityName' => $c['name'],
                'province' => $c['prov'],
                'locationType' => 'Kota',
                'latitude' => $c['lat'],
                'longitude' => $c['lng']
            ], ['cityID']);
        }

        // -------------------------
        // 3) TRANSPORT TERMINALS
        // -------------------------
        $terminals = [
            // SUMATERA bandara
            ['id' => 1, 'name' => 'Kualanamu (KNO)', 'type' => 'Bandara', 'cityID' => 90],
            ['id' => 2, 'name' => 'Sultan Syarif Kasim II (PKU)', 'type' => 'Bandara', 'cityID' => 11],
            ['id' => 3, 'name' => 'Minangkabau (PDG)', 'type' => 'Bandara', 'cityID' => 12],
            ['id' => 4, 'name' => 'Sultan Thaha (DJB)', 'type' => 'Bandara', 'cityID' => 13],
            ['id' => 5, 'name' => 'Sultan Mahmud Badaruddin II (PLM)', 'type' => 'Bandara', 'cityID' => 14],
            ['id' => 6, 'name' => 'Radin Inten II (TKG)', 'type' => 'Bandara', 'cityID' => 15],

            // JAWA bandara
            ['id' => 7, 'name' => 'Soekarno-Hatta (CGK)', 'type' => 'Bandara', 'cityID' => 21],
            ['id' => 8, 'name' => 'Juanda (SUB)', 'type' => 'Bandara', 'cityID' => 29],
            ['id' => 9, 'name' => 'YIA Yogyakarta', 'type' => 'Bandara', 'cityID' => 91],
            ['id' => 10, 'name' => 'Husein Sastranegara (BDO)', 'type' => 'Bandara', 'cityID' => 25],
            ['id' => 11, 'name' => 'Banyuwangi (BWX)', 'type' => 'Bandara', 'cityID' => 30],

            // Bali bandara
            ['id' => 12, 'name' => 'I Gusti Ngurah Rai (DPS)', 'type' => 'Bandara', 'cityID' => 41],

            // Pelabuhan
            ['id' => 20, 'name' => 'Pelabuhan Bakauheni', 'type' => 'Pelabuhan', 'cityID' => 16],
            ['id' => 21, 'name' => 'Pelabuhan Merak', 'type' => 'Pelabuhan', 'cityID' => 20],
            ['id' => 22, 'name' => 'Pelabuhan Ketapang', 'type' => 'Pelabuhan', 'cityID' => 30],
            ['id' => 23, 'name' => 'Pelabuhan Gilimanuk', 'type' => 'Pelabuhan', 'cityID' => 40],
        ];

        foreach ($terminals as $t) {
            DB::table('transport_terminals')->upsert([
                'terminalID' => $t['id'],
                'name' => $t['name'],
                'type' => $t['type'],
                'cityID' => $t['cityID'],
                'created_at' => now(),
                'updated_at' => now(),
            ], ['terminalID']);
        }

        // -------------------------
        // 4) CITY_TERMINALS mapping
        // -------------------------
        $cityTerminals = [
            // Sumatera
            ['cityID' => 10, 'terminalID' => 1, 'distance_km' => 30],
            ['cityID' => 11, 'terminalID' => 2, 'distance_km' => 10],
            ['cityID' => 12, 'terminalID' => 3, 'distance_km' => 25],
            ['cityID' => 13, 'terminalID' => 4, 'distance_km' => 10],
            ['cityID' => 14, 'terminalID' => 5, 'distance_km' => 15],
            ['cityID' => 15, 'terminalID' => 6, 'distance_km' => 25],
            ['cityID' => 16, 'terminalID' => 20, 'distance_km' => 5],

            // Jawa
            ['cityID' => 20, 'terminalID' => 21, 'distance_km' => 5],
            ['cityID' => 21, 'terminalID' => 7, 'distance_km' => 5],
            ['cityID' => 22, 'terminalID' => 7, 'distance_km' => 30],
            ['cityID' => 23, 'terminalID' => 7, 'distance_km' => 50],
            ['cityID' => 24, 'terminalID' => 7, 'distance_km' => 70],
            ['cityID' => 25, 'terminalID' => 10, 'distance_km' => 5],
            ['cityID' => 25, 'terminalID' => 7, 'distance_km' => 150],
            ['cityID' => 26, 'terminalID' => 7, 'distance_km' => 200],
            ['cityID' => 27, 'terminalID' => 9, 'distance_km' => 45],
            ['cityID' => 28, 'terminalID' => 8, 'distance_km' => 20],
            ['cityID' => 29, 'terminalID' => 8, 'distance_km' => 10],
            ['cityID' => 30, 'terminalID' => 11, 'distance_km' => 15],
            ['cityID' => 30, 'terminalID' => 22, 'distance_km' => 5],

            // Bali
            ['cityID' => 41, 'terminalID' => 12, 'distance_km' => 15],
            ['cityID' => 40, 'terminalID' => 23, 'distance_km' => 5],
        ];

        foreach ($cityTerminals as $ct) {
            DB::table('city_terminals')->upsert($ct, ['cityID', 'terminalID']);
        }

        // -------------------------
        // 5) SERVICE PROVIDERS
        // -------------------------
        $providers = [
            ['id' => 99, 'name' => 'Budgettrip Travel', 'type' => 'Transportasi'],
            ['id' => 100, 'name' => 'Budgettrip Hotel', 'type' => 'Akomodasi'],

            // airlines
            ['id' => 6, 'name' => 'Garuda Indonesia', 'type' => 'Transportasi'],
            ['id' => 7, 'name' => 'Lion Air', 'type' => 'Transportasi'],
            ['id' => 10, 'name' => 'Batik Air', 'type' => 'Transportasi'],
            ['id' => 11, 'name' => 'Super Air Jet', 'type' => 'Transportasi'],

            // ferry & buses & travel
            ['id' => 8, 'name' => 'Ferry ASDP', 'type' => 'Transportasi'],
            ['id' => 15, 'name' => 'ALS', 'type' => 'Transportasi'],
            ['id' => 16, 'name' => 'NPM', 'type' => 'Transportasi'],
            ['id' => 18, 'name' => 'Primajasa', 'type' => 'Transportasi'],
            ['id' => 5, 'name' => 'KAI', 'type' => 'Transportasi'],
            ['id' => 9, 'name' => 'DAMRI', 'type' => 'Transportasi'],
            ['id' => 20, 'name' => 'Railink', 'type' => 'Transportasi'],
            ['id' => 12, 'name' => 'XTrans', 'type' => 'Transportasi'],
            ['id' => 2, 'name' => 'DayTrans', 'type' => 'Transportasi'],
            ['id' => 1, 'name' => 'Cititrans', 'type' => 'Transportasi'],
            ['id' => 3, 'name' => 'Sinar Jaya', 'type' => 'Transportasi'],
            ['id' => 4, 'name' => 'Rosalia Indah', 'type' => 'Transportasi'],
            ['id' => 19, 'name' => 'Baraya Travel', 'type' => 'Transportasi'],

            // accommodation booking partners
            ['id' => 13, 'name' => 'Traveloka', 'type' => 'Akomodasi'],
            ['id' => 14, 'name' => 'Booking.com', 'type' => 'Akomodasi'],
            ['id' => 101, 'name' => 'Agoda', 'type' => 'Akomodasi'],
            ['id' => 102, 'name' => 'RedDoorz', 'type' => 'Akomodasi'],
            ['id' => 103, 'name' => 'OYO', 'type' => 'Akomodasi'],
            ['id' => 104, 'name' => 'Bobobox', 'type' => 'Akomodasi'],
        ];
        foreach ($providers as $p) {
            DB::table('service_providers')->upsert(['providerID' => $p['id'], 'providerName' => $p['name'], 'serviceType' => $p['type']], ['providerID']);
        }

        // -------------------------
        // 6) ACCOMMODATIONS & ATTRACTIONS
        // -------------------------
        $accommodations = [];
        $attractions = [];
        $accID = DB::table('accommodations')->max('accommodationID') ?? 1;
        $attID = DB::table('attractions')->max('attractionID') ?? 1;
        $accProviders = [13, 14, 101, 102, 103, 104];

        foreach ($cities as $city) {
            if ($city['id'] >= 90) continue; // skip airport stubs

            // 1) Budgettrip accommodation
            $accommodations[] = [
                'accommodationID' => $accID++,
                'providerID' => 100,
                'cityID' => $city['id'],
                'hotelName' => 'Budgettrip ' . $city['name'],
                'averagePricePerNight' => rand(125000, 250000),
                'rating' => 4.2,
                'type' => 'Hostel',
                'facilities' => json_encode(['WiFi']),
                'bookingLink' => null,
                'description' => 'Budgettrip official property.',
                'images' => json_encode(['https://placehold.co/600x400?text=Budgettrip+' . urlencode($city['name'])]),
                'latitude' => $city['lat'] + 0.002,
                'longitude' => $city['lng'] + 0.002,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // 2..7) Partner accommodations
            foreach ($accProviders as $provider) {
                $avg = match ($provider) {
                    13 => rand(350000, 750000), // Traveloka
                    14 => rand(450000, 1800000), // Booking.com
                    101 => rand(300000, 800000), // Agoda
                    102 => rand(150000, 250000), // RedDoorz
                    103 => rand(130000, 280000), // OYO
                    104 => rand(180000, 380000), // Bobobox
                    default => rand(200000, 500000)
                };
                $namePrefix = match ($provider) {
                    13 => 'Traveloka Stay',
                    14 => 'Premier Hotel',
                    101 => 'Agoda Inn',
                    102 => 'RedDoorz Room',
                    103 => 'OYO Comfort',
                    104 => 'Bobobox Pod',
                    default => 'Partner Hotel'
                };
                $accommodations[] = [
                    'accommodationID' => $accID++,
                    'providerID' => $provider,
                    'cityID' => $city['id'],
                    'hotelName' => "{$namePrefix} {$city['name']}",
                    'averagePricePerNight' => $avg,
                    'rating' => rand(3, 5),
                    'type' => ($avg > 600000 ? 'Hotel' : 'Budget Hotel'),
                    'facilities' => json_encode(['WiFi', 'AC']),
                    'bookingLink' => 'https://booking.com',
                    'description' => "Booking via provider ID {$provider}.",
                    'images' => json_encode(['https://placehold.co/600x400?text=' . urlencode($namePrefix)]),
                    'latitude' => $city['lat'] + (rand(-5, 5) * 0.0005),
                    'longitude' => $city['lng'] + (rand(-5, 5) * 0.0005),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            // Attraction
            $attractions[] = [
                'attractionID' => $attID++,
                'cityID' => $city['id'],
                'attractionName' => 'Landmark ' . $city['name'],
                'category' => 'Hiburan',
                'estimatedCost' => 0,
                'rating' => 4.4,
                'reviewCount' => rand(20, 500),
                'description' => 'Ikon kota.',
                'bookingLink' => null,
                'images' => json_encode(['https://placehold.co/600x400?text=Attraction']),
                'latitude' => $city['lat'],
                'longitude' => $city['lng'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        if (!empty($accommodations)) DB::table('accommodations')->insert($accommodations);
        if (!empty($attractions)) DB::table('attractions')->insert($attractions);

        // -------------------------
        // 7) ROUTES GENERATOR
        // -------------------------
        $routesData = [];
        $routeID = DB::table('transport_routes')->max('routeID') ?? 1;

        $findCity = fn($id) => collect($cities)->firstWhere('id', $id);
        $nearestTerminal = function ($cityID) use ($cityTerminals) {
            $cands = array_filter($cityTerminals, fn($ct) => $ct['cityID'] === $cityID);
            if (empty($cands)) return null;
            usort($cands, fn($a, $b) => $a['distance_km'] <=> $b['distance_km']);
            return $cands[0]['terminalID'];
        };

        // Create 3 schedules helper
        $createSchedules = function ($providerID, $originId, $destId, $type, $price, $class, $seats, $facilities, &$routeID, $cities) {
            $origin = null;
            $dest = null;
            foreach ($cities as $c) {
                if ($c['id'] === $originId) $origin = $c;
                if ($c['id'] === $destId) $dest = $c;
            }
            if (!$origin || !$dest) return [];

            $times = ['07:00:00', '13:00:00', '19:00:00'];
            $classes = [' (Pagi)', ' (Siang)', ' (Malam)'];
            $batch = [];

            // Estimate duration
            $dist = sqrt(pow($origin['lat'] - $dest['lat'], 2) + pow($origin['lng'] - $dest['lng'], 2)) * 111;
            $speed = str_contains($type, 'Pesawat') ? 700 : (str_contains($type, 'Ferry') ? 25 : 50);
            $durationHours = max(1, round($dist / $speed));

            foreach ($times as $i => $time) {
                $arrival = date('H:i:s', strtotime($time) + $durationHours * 3600);
                $batch[] = [
                    'routeID' => $routeID++,
                    'providerID' => $providerID,
                    'originCityID' => $originId,
                    'destinationCityID' => $destId,
                    'averagePrice' => $price,
                    'departureTime' => $time,
                    'arrivalTime' => $arrival,
                    'class' => $class . $classes[$i],
                    'total_seats' => $seats,
                    'facilities' => json_encode($facilities),
                    'bookingLink' => ($providerID == 99 ? null : "https://ticket.com/route/{$routeID}"),
                    'description' => "{$type} {$origin['name']} -> {$dest['name']}",
                    'images' => json_encode(['https://placehold.co/600x400?text=' . urlencode($type)]),
                    'start_latitude' => $origin['lat'],
                    'start_longitude' => $origin['lng'],
                    'end_latitude' => $dest['lat'],
                    'end_longitude' => $dest['lng'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            return $batch;
        };

        // 7A) Budgettrip MESH (All cities connected - Updated Prices)
        $cityIDsMesh = array_column(array_filter($cities, fn($c) => $c['id'] < 90), 'id');
        foreach ($cityIDsMesh as $orig) {
            foreach ($cityIDsMesh as $dest) {
                if ($orig == $dest) continue;
                $o = $findCity($orig);
                $d = $findCity($dest);
                if (!$o || !$d) continue;

                $dist = sqrt(pow($o['lat'] - $d['lat'], 2) + pow($o['lng'] - $d['lng'], 2)) * 111;
                $isSameIsland = $o['island'] === $d['island'];

                if ($isSameIsland) {
                    if ($dist <= 200) {
                        $type = 'Travel';
                        $class = 'Budgettrip Shuttle';
                        // Travel Short: 75k base + dist cost
                        $price = max(75000, round(50000 + $dist * 800));
                        $seats = 12;
                    } else {
                        $type = 'Bus';
                        $class = 'Budgettrip Executive';
                        // Bus Long: 150k base + dist cost
                        $price = max(150000, round(100000 + $dist * 600));
                        $seats = 30;
                    }
                } else {
                    $type = 'Bus Antar Pulau (via Ferry)';
                    $class = 'Budgettrip Longhaul';
                    // Cross Island: expensive
                    $price = max(350000, round(250000 + $dist * 600));
                    $seats = 30;
                }

                $routesData = array_merge($routesData, $createSchedules(99, $orig, $dest, $type, $price, $class, $seats, ['AC'], $routeID, $cities));
            }
        }

        // 7B) FEEDER ROUTES (City <-> Nearest Airport - Updated Prices)
        foreach ($cityIDsMesh as $cid) {
            $tid = $nearestTerminal($cid);
            if (!$tid) continue;
            $termInfo = collect($terminals)->firstWhere('id', $tid);
            $destCityID = $termInfo['cityID'];
            if (!$destCityID) continue;

            $dist = sqrt(pow($findCity($cid)['lat'] - $findCity($destCityID)['lat'], 2) + pow($findCity($cid)['lng'] - $findCity($destCityID)['lng'], 2)) * 111;
            // Feeder price: Expensive per km (taxi/private shuttle rate)
            $price = round(50000 + $dist * 1000);

            $routesData = array_merge(
                $routesData,
                $createSchedules(99, $cid, $destCityID, 'Airport Transfer', $price, 'Budgettrip Shuttle', 12, ['AC', 'Bagasi'], $routeID, $cities),
                $createSchedules(99, $destCityID, $cid, 'Airport Transfer', $price, 'Budgettrip Shuttle', 12, ['AC', 'Bagasi'], $routeID, $cities)
            );
        }

        // 7C) FLIGHT MESH (Airport <-> Airport - Updated Prices)
        $airportTerminals = array_filter($terminals, fn($t) => $t['type'] === 'Bandara');
        $airportCityIDs = array_column($airportTerminals, 'cityID');
        $airlines = [6, 7, 10, 11];

        foreach ($airportCityIDs as $a) {
            foreach ($airportCityIDs as $b) {
                if ($a == $b) continue;
                $o = $findCity($a);
                $d = $findCity($b);
                $dist = sqrt(pow($o['lat'] - $d['lat'], 2) + pow($o['lng'] - $d['lng'], 2)) * 111;

                // Flight Base Price + Distance Factor
                $basePrice = 800000;
                $price = round($basePrice + ($dist * 2000));

                foreach ($airlines as $prov) {
                    $finalPrice = ($prov == 6 || $prov == 10) ? $price * 1.3 : $price; // Garuda/Batik more expensive
                    $routesData = array_merge($routesData, $createSchedules($prov, $a, $b, 'Pesawat', $finalPrice, 'Economy', 150, ['Bagasi 20kg'], $routeID, $cities));
                }
            }
        }

        // 7D) FERRY ROUTES
        $ferryPairs = [
            [20, 16, 25000],
            [16, 20, 25000], // Merak-Bakauheni
            [30, 40, 15000],
            [40, 30, 15000], // Ketapang-Gilimanuk
        ];
        foreach ($ferryPairs as [$a, $b, $price]) {
            $routesData = array_merge($routesData, $createSchedules(8, $a, $b, 'Ferry ASDP', $price, 'Reguler', 400, ['Kantin'], $routeID, $cities));
        }

        // 7E) REAL BUS & TRAIN (Updated Prices)
        $longBusPairs = [
            [15, 10, 22],
            [14, 10, 22],
            [11, 10, 22],
            [12, 10, 22], // Sumatera->Jawa
            [18, 22, 28],
            [18, 24, 25], // Primajasa
            [16, 12, 22], // NPM Padang-Jkt
            [15, 14, 22], // ALS Palembang-Jkt
            [17, 28, 41], // Pahala Kencana Sby-Bali
        ];
        foreach ($longBusPairs as [$prov, $a, $b]) {
            $provID = in_array($prov, array_column($providers, 'id')) ? $prov : 15;
            // Bus AKAP Price
            $price = rand(400000, 850000);
            $routesData = array_merge($routesData, $createSchedules($provID, $a, $b, 'Bus AKAP', $price, 'Executive', 30, ['AC', 'Toilet'], $routeID, $cities));
            $routesData = array_merge($routesData, $createSchedules($provID, $b, $a, 'Bus AKAP', $price, 'Executive', 30, ['AC', 'Toilet'], $routeID, $cities));
        }

        $trainPairs = [
            [22, 25],
            [22, 27],
            [22, 28],
            [25, 27],
            [25, 28],
            [27, 28],
            [22, 30],
            [25, 26],
            [26, 28],
            [23, 25]
        ];
        foreach ($trainPairs as [$a, $b]) {
            $price = rand(150000, 650000); // Train price range
            $routesData = array_merge($routesData, $createSchedules(5, $a, $b, 'Kereta', $price, 'Eksekutif', 60, ['AC'], $routeID, $cities));
            $routesData = array_merge($routesData, $createSchedules(5, $b, $a, 'Kereta', $price, 'Eksekutif', 60, ['AC'], $routeID, $cities));
        }

        $travelOperators = [12, 2, 1, 3, 19];
        $travelPairs = [
            [22, 25],
            [25, 26],
            [22, 23],
            [24, 25],
            [27, 25],
            [28, 29],
            [23, 24],
            [21, 22],
            [20, 21],
            [25, 26],
            [10, 11],
            [11, 12],
            [12, 13],
            [13, 14],
            [14, 15],
            [15, 16],
            [28, 30],
            [27, 26],
            [25, 23],
            [22, 28],
            [24, 23],
            [26, 22],
            [27, 22],
            [30, 41],
            [21, 25]
        ];
        foreach ($travelPairs as $idx => [$a, $b]) {
            $op = $travelOperators[$idx % count($travelOperators)];
            $price = rand(90000, 200000); // Travel price range
            $routesData = array_merge($routesData, $createSchedules($op, $a, $b, 'Travel', $price, 'Shuttle', 12, ['AC'], $routeID, $cities));
            $routesData = array_merge($routesData, $createSchedules($op, $b, $a, 'Travel', $price, 'Shuttle', 12, ['AC'], $routeID, $cities));
        }

        foreach (array_chunk($routesData, 500) as $chunk) {
            DB::table('transport_routes')->insert($chunk);
        }

        // 8) DUMMY PLAN
        DB::table('travel_plans')->upsert([[
            'planID' => 1,
            'userID' => 1,
            'planName' => 'Trip Mudik',
            'amount' => 5000000,
            'originCityID' => 14,
            'destinationCityID' => 21,
            'accommodationCityID' => 21,
            'startDate' => '2025-06-01',
            'endDate' => '2025-06-05',
            'created_at' => now(),
            'updated_at' => now()
        ]], ['planID']);

        DB::table('itineraries')->upsert([[
            'itineraryID' => 1,
            'planID' => 1,
            'itineraryName' => 'Rencana A',
            'created_at' => now(),
            'updated_at' => now(),
        ]], ['itineraryID']);
    }
}
