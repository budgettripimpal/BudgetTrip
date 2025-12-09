<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        // 2) CITIES (Kota Utama & Transit Point)
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

            // BANDARA (Lokasi Fisik)
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
                'longitude' => $c['lng'],
                'created_at' => now(),
                'updated_at' => now()
            ], ['cityID']);
        }

        // -------------------------
        // 3) TRANSPORT TERMINALS
        // -------------------------
        $terminals = [
            // SUMATERA
            ['id' => 1, 'name' => 'Kualanamu (KNO)', 'type' => 'Bandara', 'cityID' => 90],
            ['id' => 2, 'name' => 'Sultan Syarif Kasim II (PKU)', 'type' => 'Bandara', 'cityID' => 11],
            ['id' => 3, 'name' => 'Minangkabau (PDG)', 'type' => 'Bandara', 'cityID' => 12],
            ['id' => 4, 'name' => 'Sultan Thaha (DJB)', 'type' => 'Bandara', 'cityID' => 13],
            ['id' => 5, 'name' => 'Sultan Mahmud Badaruddin II (PLM)', 'type' => 'Bandara', 'cityID' => 14],
            ['id' => 6, 'name' => 'Radin Inten II (TKG)', 'type' => 'Bandara', 'cityID' => 15],

            // JAWA
            ['id' => 7, 'name' => 'Soekarno-Hatta (CGK)', 'type' => 'Bandara', 'cityID' => 21],
            ['id' => 8, 'name' => 'Juanda (SUB)', 'type' => 'Bandara', 'cityID' => 29],
            ['id' => 9, 'name' => 'YIA Yogyakarta', 'type' => 'Bandara', 'cityID' => 91],
            ['id' => 10, 'name' => 'Husein Sastranegara (BDO)', 'type' => 'Bandara', 'cityID' => 25],
            ['id' => 11, 'name' => 'Banyuwangi (BWX)', 'type' => 'Bandara', 'cityID' => 30],

            // BALI
            ['id' => 12, 'name' => 'I Gusti Ngurah Rai (DPS)', 'type' => 'Bandara', 'cityID' => 41],

            // PELABUHAN
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
                'updated_at' => now()
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
            ['id' => 6, 'name' => 'Garuda Indonesia', 'type' => 'Transportasi'],
            ['id' => 7, 'name' => 'Lion Air', 'type' => 'Transportasi'],
            ['id' => 10, 'name' => 'Batik Air', 'type' => 'Transportasi'],
            ['id' => 11, 'name' => 'Super Air Jet', 'type' => 'Transportasi'],
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

        // helper to create realistic booking links per provider
        $providerBookingUrl = function ($providerID, $entityType, $cityName, $suffix = '') {
            $slug = Str::slug($cityName);
            return match ($providerID) {
                13 => "https://www.traveloka.com/hotel/id/{$slug}{$suffix}",
                14 => "https://www.booking.com/searchresults.html?ss={$slug}",
                101 => "https://www.agoda.com/search?city={$slug}",
                102 => "https://www.reddoorz.com/en-id/hotel/{$slug}",
                103 => "https://www.oyorooms.com/id/hotel/{$slug}",
                104 => "https://www.bobobox.com/search?location={$slug}",
                6, 7, 10, 11 => "https://www.tiket.com/pesawat/{$slug}",
                5 => "https://ticket.kai.id/search?from={$slug}",
                8 => "https://www.asdp.id/jadwal/{$slug}",
                default => ($entityType === 'accommodation' ? "https://www.tiket.com/hotel/{$slug}" : "https://www.tiket.com/transport/{$slug}")
            };
        };

        // iconic attractions per city (name, category, estimatedCost, optional booking link)
        $iconic = [
            // SOME EXAMPLES; will be used where relevant
            22 => [ // Jakarta
                ['name' => 'Monumen Nasional (Monas)', 'category' => 'Landmark', 'price' => 5000, 'link' => null],
                ['name' => 'Kota Tua Jakarta', 'category' => 'Sejarah & Budaya', 'price' => 0, 'link' => null],
            ],
            27 => [ // Yogyakarta
                ['name' => 'Candi Prambanan', 'category' => 'Sejarah & Budaya', 'price' => 50000, 'link' => 'https://www.ticket.prambanan.com'],
                ['name' => 'Keraton Yogyakarta', 'category' => 'Sejarah & Budaya', 'price' => 15000, 'link' => null],
                ['name' => 'Candi Borobudur (Magelang dekat Yogyakarta)', 'category' => 'Sejarah & Budaya', 'price' => 75000, 'link' => 'https://www.borobudurpark.com/tickets'],
            ],
            28 => [ // Surabaya
                ['name' => 'Tugu Pahlawan', 'category' => 'Sejarah & Budaya', 'price' => 0, 'link' => null],
                ['name' => 'House of Sampoerna', 'category' => 'Museum', 'price' => 20000, 'link' => null],
            ],
            41 => [ // Denpasar/Bali
                ['name' => 'Pura Tanah Lot (Bali)', 'category' => 'Sejarah & Budaya', 'price' => 30000, 'link' => 'https://www.tanahlot.net/ticket'],
                ['name' => 'Garuda Wisnu Kencana (GWK)', 'category' => 'Landmark', 'price' => 50000, 'link' => 'https://www.gwk.co.id/tickets'],
            ],
            10 => [ // Medan
                ['name' => 'Danau Toba (akses dari Medan)', 'category' => 'Alam', 'price' => 0, 'link' => null],
                ['name' => 'Istana Maimun', 'category' => 'Sejarah & Budaya', 'price' => 10000, 'link' => null],
            ],
            25 => [ // Bandung
                ['name' => 'Tangkuban Perahu', 'category' => 'Alam', 'price' => 30000, 'link' => null],
                ['name' => 'Kawah Putih', 'category' => 'Alam', 'price' => 20000, 'link' => null],
            ],
            30 => [ // Banyuwangi
                ['name' => 'Kawah Ijen', 'category' => 'Alam', 'price' => 45000, 'link' => 'https://www.kawahijen.com/tickets'],
                ['name' => 'Pantai Pulau Merah', 'category' => 'Alam', 'price' => 0, 'link' => null],
            ],
            12 => [ // Padang
                ['name' => 'Pantai Air Manis', 'category' => 'Alam', 'price' => 0, 'link' => null],
            ],
            14 => [ // Palembang
                ['name' => 'Jembatan Ampera', 'category' => 'Landmark', 'price' => 0, 'link' => null],
            ],
            15 => [ // Bandar Lampung
                ['name' => 'Taman Gajah', 'category' => 'Rekreasi', 'price' => 0, 'link' => null],
            ],
            26 => [ // Cirebon
                ['name' => 'Keraton Kasepuhan', 'category' => 'Sejarah & Budaya', 'price' => 10000, 'link' => null],
            ],
            // fallback and additional cities can be extended similarly
        ];

        // For each city (except airport-only ones), create 6 accommodations and multiple attractions (including iconic)
        foreach ($cities as $city) {
            if ($city['id'] >= 90) continue; // skip airport-only entries for accommodations/attractions

            $cityName = $city['name'];
            $slugCity = Str::slug($cityName);

            // 1) Budgettrip property
            $accommodations[] = [
                'accommodationID' => $accID++,
                'providerID' => 100, // Budgettrip Hotel
                'cityID' => $city['id'],
                'hotelName' => "Budgettrip {$cityName}",
                'averagePricePerNight' => rand(150000, 300000),
                'rating' => round(rand(35, 45) / 10, 1),
                'type' => 'Hostel',
                'facilities' => json_encode(['WiFi', 'AC']),
                'bookingLink' => null,
                'description' => 'Official Budgettrip property. Hemat dan nyaman.',
                'images' => json_encode(["https://placehold.co/600x400?text=" . urlencode("Budgettrip {$cityName}")]),
                'latitude' => $city['lat'] + 0.001,
                'longitude' => $city['lng'] + 0.001,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // 2..6) Partner hotels (5 partners)
            $accPartners = [
                ['provider' => 13, 'prefix' => 'Traveloka Stay', 'min' => 300000, 'max' => 600000],
                ['provider' => 14, 'prefix' => 'Premier Hotel', 'min' => 400000, 'max' => 1500000],
                ['provider' => 101, 'prefix' => 'Agoda Inn', 'min' => 250000, 'max' => 700000],
                ['provider' => 102, 'prefix' => 'RedDoorz Room', 'min' => 120000, 'max' => 200000],
                ['provider' => 103, 'prefix' => 'OYO Comfort', 'min' => 120000, 'max' => 250000],
            ];

            foreach ($accPartners as $pinfo) {
                $avg = rand($pinfo['min'], $pinfo['max']);
                $accommodations[] = [
                    'accommodationID' => $accID++,
                    'providerID' => $pinfo['provider'],
                    'cityID' => $city['id'],
                    'hotelName' => "{$pinfo['prefix']} {$cityName}",
                    'averagePricePerNight' => $avg,
                    'rating' => round(rand(30, 50) / 10, 1),
                    'type' => ($avg > 600000 ? 'Hotel' : 'Budget Hotel'),
                    'facilities' => json_encode(['WiFi', 'AC', 'Sarapan']),
                    'bookingLink' => $providerBookingUrl($pinfo['provider'], 'accommodation', $cityName),
                    'description' => "Booking via provider ID {$pinfo['provider']}.",
                    'images' => json_encode(["https://placehold.co/600x400?text=" . urlencode("{$pinfo['prefix']} {$cityName}")]),
                    'latitude' => $city['lat'] + (rand(-5, 5) * 0.0007),
                    'longitude' => $city['lng'] + (rand(-5, 5) * 0.0007),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Attractions: Add iconic ones if defined
            if (isset($iconic[$city['id']])) {
                foreach ($iconic[$city['id']] as $icon) {
                    $attractions[] = [
                        'attractionID' => $attID++,
                        'cityID' => $city['id'],
                        'attractionName' => $icon['name'],
                        'category' => $icon['category'],
                        'estimatedCost' => $icon['price'],
                        'rating' => round(rand(30, 50) / 10, 1),
                        'reviewCount' => rand(50, 2000),
                        'description' => "Ikon & destinasi populer - {$icon['name']}.",
                        'bookingLink' => $icon['link'] ?? null,
                        'images' => json_encode(["https://placehold.co/600x400?text=" . urlencode($icon['name'])]),
                        'latitude' => $city['lat'] + (rand(-3, 3) * 0.0008),
                        'longitude' => $city['lng'] + (rand(-3, 3) * 0.0008),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            // Add 2-3 additional random attractions per city (some free, some paid)
            $extraCount = rand(2, 3);
            for ($i = 0; $i < $extraCount; $i++) {
                $isFree = rand(0, 2) === 0; // ~33% free
                $price = $isFree ? 0 : rand(10000, 150000);
                $hasLink = !$isFree && (rand(0, 1) === 1); // if paid, 50% chance has link
                $name = ($isFree ? "Taman Kota " : "Atraksi ") . ($i + 1) . " {$cityName}";
                $attractions[] = [
                    'attractionID' => $attID++,
                    'cityID' => $city['id'],
                    'attractionName' => $name,
                    'category' => $isFree ? 'Rekreasi' : 'Wisata',
                    'estimatedCost' => $price,
                    'rating' => round(rand(25, 50) / 10, 1),
                    'reviewCount' => rand(5, 800),
                    'description' => "Tempat populer di {$cityName}.",
                    'bookingLink' => $hasLink ? "https://www.tiket.com/ticket/{$slugCity}/" . rand(100, 999) : null,
                    'images' => json_encode(["https://placehold.co/600x400?text=" . urlencode($name)]),
                    'latitude' => $city['lat'] + (rand(-6, 6) * 0.0006),
                    'longitude' => $city['lng'] + (rand(-6, 6) * 0.0006),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        if (!empty($accommodations)) {
            // delete existing (optional) or upsert; to avoid duplicates we'll insert only missing ones
            DB::table('accommodations')->insert($accommodations);
        }
        if (!empty($attractions)) {
            DB::table('attractions')->insert($attractions);
        }

        // -------------------------
        // 7) ROUTES GENERATOR (transport_routes)
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

        // createSchedules helper (reused)
        $createSchedules = function ($providerID, $originId, $destId, $type, $price, $class, $seats, $facilities, &$routeID, $cities) {
            $origin = null;
            $dest = null;
            foreach ($cities as $c) {
                if ($c['id'] === $originId) $origin = $c;
                if ($c['id'] === $destId) $dest = $c;
            }
            if (!$origin || !$dest) return [];

            $times = ['07:00:00', '13:00:00', '19:00:00'];
            $classesTag = [' (Pagi)', ' (Siang)', ' (Malam)'];
            $batch = [];

            // Calculate Distance (approx) and duration
            $dist = sqrt(pow($origin['lat'] - $dest['lat'], 2) + pow($origin['lng'] - $dest['lng'], 2)) * 111;
            // Speed heuristic
            $speed = str_contains(strtolower($type), 'pesawat') ? 700 : (str_contains(strtolower($type), 'ferry') ? 25 : (str_contains(strtolower($type), 'kereta') ? 80 : 50));
            $hours = $dist / max(1, $speed);
            $durationSeconds = intval($hours * 3600);
            $durationSeconds = max(3600, $durationSeconds);
            $durationSeconds += rand(0, 2700);

            foreach ($times as $i => $time) {
                $arrival = date('H:i:s', strtotime($time) + $durationSeconds);
                $batch[] = [
                    'routeID' => $routeID++,
                    'providerID' => $providerID,
                    'originCityID' => $originId,
                    'destinationCityID' => $destId,
                    'averagePrice' => $price,
                    'departureTime' => $time,
                    'arrivalTime' => $arrival,
                    'class' => $class . $classesTag[$i],
                    'total_seats' => $seats,
                    'facilities' => json_encode($facilities),
                    'bookingLink' => ($providerID == 99 ? null : (str_contains((string)$providerID, 'http') ? (string)$providerID : (in_array($providerID, [6, 7, 10, 11]) ? "https://www.tiket.com/pesawat" : "https://www.tiket.com/transport"))),
                    'description' => "{$type} from {$origin['name']} to {$dest['name']}",
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

        // 7A) Budgettrip mesh (connect most cities)
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
                        $price = round(70000 + $dist * 400);
                        $seats = 12;
                    } else {
                        $type = 'Bus';
                        $class = 'Budgettrip Executive';
                        $price = round(120000 + $dist * 350);
                        $seats = 30;
                    }
                } else {
                    $type = 'Bus Antar Pulau (via Ferry)';
                    $class = 'Budgettrip Longhaul';
                    $price = round(350000 + $dist * 400);
                    $seats = 30;
                }

                $routesData = array_merge($routesData, $createSchedules(99, $orig, $dest, $type, $price, $class, $seats, ['AC'], $routeID, $cities));
            }
        }

        // 7B) Feeder (city <-> nearest airport)
        foreach ($cityIDsMesh as $cid) {
            $tid = $nearestTerminal($cid);
            if (!$tid) continue;
            $termInfo = collect($terminals)->firstWhere('id', $tid);
            $destCityID = $termInfo['cityID'] ?? null;
            if (!$destCityID) continue;

            $dist = sqrt(pow($findCity($cid)['lat'] - $findCity($destCityID)['lat'], 2) + pow($findCity($cid)['lng'] - $findCity($destCityID)['lng'], 2)) * 111;
            $price = round(50000 + $dist * 1000);

            $routesData = array_merge(
                $routesData,
                $createSchedules(99, $cid, $destCityID, 'Airport Transfer', $price, 'Budgettrip Shuttle', 12, ['AC', 'Bagasi'], $routeID, $cities),
                $createSchedules(99, $destCityID, $cid, 'Airport Transfer', $price, 'Budgettrip Shuttle', 12, ['AC', 'Bagasi'], $routeID, $cities)
            );
        }

        // 7C) Flights mesh between airports
        $airportTerminals = array_filter($terminals, fn($t) => $t['type'] === 'Bandara');
        $airportCityIDs = array_column($airportTerminals, 'cityID');
        $airlines = [6, 7, 10, 11];
        foreach ($airportCityIDs as $a) {
            foreach ($airportCityIDs as $b) {
                if ($a == $b) continue;
                $o = $findCity($a);
                $d = $findCity($b);
                if (!$o || !$d) continue;
                $dist = sqrt(pow($o['lat'] - $d['lat'], 2) + pow($o['lng'] - $d['lng'], 2)) * 111;
                $basePrice = 800000;
                $price = round($basePrice + ($dist * 2000));
                foreach ($airlines as $prov) {
                    $finalPrice = ($prov == 6 || $prov == 10) ? round($price * 1.3) : $price;
                    $routesData = array_merge($routesData, $createSchedules($prov, $a, $b, 'Pesawat', $finalPrice, 'Economy', 150, ['Bagasi 20kg'], $routeID, $cities));
                }
            }
        }

        // 7D) Ferry routes (ASDP)
        $ferryPairs = [
            [20, 16, 25000],
            [16, 20, 25000],
            [30, 40, 15000],
            [40, 30, 15000],
        ];
        foreach ($ferryPairs as [$a, $b, $price]) {
            $routesData = array_merge($routesData, $createSchedules(8, $a, $b, 'Ferry ASDP', $price, 'Reguler', 400, ['Kantin'], $routeID, $cities));
        }

        // 7E) Bus & train realistic pairs
        $longBusPairs = [
            [15, 10, 22],
            [14, 10, 22],
            [11, 10, 22],
            [12, 10, 22],
            [18, 22, 28],
            [18, 24, 25],
            [16, 12, 22],
            [15, 14, 22],
            [17, 28, 41],
        ];
        foreach ($longBusPairs as [$prov, $a, $b]) {
            $provID = in_array($prov, array_column($providers, 'id')) ? $prov : 15;
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
            $price = rand(150000, 650000);
            $routesData = array_merge($routesData, $createSchedules(5, $a, $b, 'Kereta', $price, 'Eksekutif', 60, ['AC'], $routeID, $cities));
            $routesData = array_merge($routesData, $createSchedules(5, $b, $a, 'Kereta', $price, 'Eksekutif', 60, ['AC'], $routeID, $cities));
        }

        // 7F) Travel operators (shuttle) realistic pairs
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
            $price = rand(90000, 200000);
            $routesData = array_merge($routesData, $createSchedules($op, $a, $b, 'Travel', $price, 'Shuttle', 12, ['AC'], $routeID, $cities));
            $routesData = array_merge($routesData, $createSchedules($op, $b, $a, 'Travel', $price, 'Shuttle', 12, ['AC'], $routeID, $cities));
        }

        // Insert routes in chunks to avoid oversized queries
        foreach (array_chunk($routesData, 500) as $chunk) {
            DB::table('transport_routes')->insert($chunk);
        }

        // -------------------------
        // 8) DUMMY PLAN & ITINERARY
        // -------------------------
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
