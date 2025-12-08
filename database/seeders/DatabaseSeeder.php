<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. USERS (DIPERBANYAK AGAR TIDAK ERROR)
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
                'id' => 3,
                'name' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'password' => Hash::make('password'),
                'phoneNumber' => '081234567892',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password'),
                'phoneNumber' => '081234567893',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // ADMIN
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

        // 2. CITIES (LENGKAP DENGAN KOORDINAT)
        DB::table('cities')->insert([
            ['cityID' => 1, 'cityName' => 'Bandung', 'province' => 'Jawa Barat', 'locationType' => 'Kota', 'latitude' => -6.917464, 'longitude' => 107.619123],
            ['cityID' => 2, 'cityName' => 'Palembang', 'province' => 'Sumatera Selatan', 'locationType' => 'Kota', 'latitude' => -2.976074, 'longitude' => 104.775431],
            ['cityID' => 3, 'cityName' => 'Jakarta', 'province' => 'DKI Jakarta', 'locationType' => 'Kota', 'latitude' => -6.208763, 'longitude' => 106.845599],
            ['cityID' => 4, 'cityName' => 'Yogyakarta', 'province' => 'DIY', 'locationType' => 'Kota', 'latitude' => -7.795580, 'longitude' => 110.369490],
            ['cityID' => 5, 'cityName' => 'Bali (Denpasar)', 'province' => 'Bali', 'locationType' => 'Kota', 'latitude' => -8.670458, 'longitude' => 115.212629],
            ['cityID' => 6, 'cityName' => 'Surabaya', 'province' => 'Jawa Timur', 'locationType' => 'Kota', 'latitude' => -7.257472, 'longitude' => 112.752088],
            ['cityID' => 7, 'cityName' => 'Malang', 'province' => 'Jawa Timur', 'locationType' => 'Kota', 'latitude' => -7.966620, 'longitude' => 112.632632],
            ['cityID' => 8, 'cityName' => 'Labuan Bajo', 'province' => 'NTT', 'locationType' => 'Kota', 'latitude' => -8.453483, 'longitude' => 119.873278],
            ['cityID' => 9, 'cityName' => 'Medan', 'province' => 'Sumatera Utara', 'locationType' => 'Kota', 'latitude' => 3.595196, 'longitude' => 98.672223],
            ['cityID' => 10, 'cityName' => 'Semarang', 'province' => 'Jawa Tengah', 'locationType' => 'Kota', 'latitude' => -6.966667, 'longitude' => 110.416664],
        ]);

        // 3. SERVICE PROVIDERS
        DB::table('service_providers')->insert([
            ['providerID' => 1, 'providerName' => 'Cititrans', 'serviceType' => 'Transportasi'],
            ['providerID' => 2, 'providerName' => 'Bus ALS', 'serviceType' => 'Transportasi'],
            ['providerID' => 3, 'providerName' => 'Garuda Indonesia', 'serviceType' => 'Transportasi'],
            ['providerID' => 4, 'providerName' => 'Booking.com', 'serviceType' => 'Akomodasi'],
            ['providerID' => 5, 'providerName' => 'KAI (Kereta Api)', 'serviceType' => 'Transportasi'],
            ['providerID' => 6, 'providerName' => 'Lion Air', 'serviceType' => 'Transportasi'],
            ['providerID' => 7, 'providerName' => 'Traveloka', 'serviceType' => 'Akomodasi'],

            // PROVIDER KHUSUS BUDGETTRIP (UNTUK FITUR PEMBAYARAN)
            ['providerID' => 99, 'providerName' => 'Budgettrip Travel', 'serviceType' => 'Transportasi'],
            ['providerID' => 100, 'providerName' => 'Budgettrip Hotel', 'serviceType' => 'Akomodasi'],
        ]);

        // 4. ATTRACTIONS (Objek Wisata Lebih Banyak)
        DB::table('attractions')->insert([
            // BANDUNG
            ['attractionID' => 1, 'cityID' => 1, 'attractionName' => 'Kawah Putih', 'category' => 'Alam', 'estimatedCost' => 28000, 'rating' => 4.7, 'reviewCount' => 1200, 'description' => 'Danau kawah vulkanik dengan air berwarna putih kehijauan.', 'bookingLink' => 'https://ticket.com/kawah-putih', 'images' => json_encode(['https://asset.kompas.com/crops/O5-K0qq_u3e7zB9i1p7l6s2d_0=/0x0:1000x667/750x500/data/photo/2020/03/10/5e670b8a4b6b6.jpg']), 'latitude' => -7.166204, 'longitude' => 107.402126, 'created_at' => now(), 'updated_at' => now()],
            ['attractionID' => 2, 'cityID' => 1, 'attractionName' => 'Trans Studio Bandung', 'category' => 'Hiburan', 'estimatedCost' => 200000, 'rating' => 4.5, 'reviewCount' => 2500, 'description' => 'Taman hiburan indoor terbesar.', 'bookingLink' => 'https://transstudiobandung.com', 'images' => json_encode(['https://www.transstudiobandung.com/images/slider/1.jpg']), 'latitude' => -6.923700, 'longitude' => 107.636400, 'created_at' => now(), 'updated_at' => now()],

            // JOGJA
            ['attractionID' => 3, 'cityID' => 4, 'attractionName' => 'Candi Borobudur', 'category' => 'Sejarah & Budaya', 'estimatedCost' => 50000, 'rating' => 4.9, 'reviewCount' => 5000, 'description' => 'Candi Buddha terbesar di dunia.', 'bookingLink' => 'https://borobudurpark.com', 'images' => json_encode(['https://upload.wikimedia.org/wikipedia/commons/8/8c/Borobudur-Northeast_view.jpg']), 'latitude' => -7.607874, 'longitude' => 110.203751, 'created_at' => now(), 'updated_at' => now()],
            ['attractionID' => 4, 'cityID' => 4, 'attractionName' => 'Jalan Malioboro', 'category' => 'Belanja', 'estimatedCost' => 0, 'rating' => 4.7, 'reviewCount' => 10000, 'description' => 'Jantung kota Yogyakarta, pusat belanja dan kuliner.', 'bookingLink' => null, 'images' => json_encode(['https://visitingjogja.jogjaprov.go.id/wp-content/uploads/2020/04/malioboro.jpg']), 'latitude' => -7.792622, 'longitude' => 110.365842, 'created_at' => now(), 'updated_at' => now()],

            // BALI
            ['attractionID' => 5, 'cityID' => 5, 'attractionName' => 'Pantai Kuta', 'category' => 'Alam', 'estimatedCost' => 0, 'rating' => 4.6, 'reviewCount' => 8000, 'description' => 'Pantai paling populer di Bali dengan sunset yang indah.', 'bookingLink' => null, 'images' => json_encode(['https://upload.wikimedia.org/wikipedia/commons/a/a3/Kuta_Beach_Bali.jpg']), 'latitude' => -8.718484, 'longitude' => 115.168625, 'created_at' => now(), 'updated_at' => now()],
            ['attractionID' => 6, 'cityID' => 5, 'attractionName' => 'Garuda Wisnu Kencana (GWK)', 'category' => 'Sejarah & Budaya', 'estimatedCost' => 125000, 'rating' => 4.8, 'reviewCount' => 4000, 'description' => 'Taman budaya dengan patung raksasa Dewa Wisnu.', 'bookingLink' => 'https://gwkbali.com', 'images' => json_encode(['https://www.indonesia.travel/content/dam/indtravelrevamp/en/destinations/bali-nusa-tenggara/bali/garuda-wisnu-kencana-cultural-park/gwk.jpg']), 'latitude' => -8.810574, 'longitude' => 115.166343, 'created_at' => now(), 'updated_at' => now()],

            // PALEMBANG
            ['attractionID' => 7, 'cityID' => 2, 'attractionName' => 'Jembatan Ampera', 'category' => 'Landmark', 'estimatedCost' => 0, 'rating' => 4.8, 'reviewCount' => 3000, 'description' => 'Ikon kota Palembang yang megah.', 'bookingLink' => null, 'images' => json_encode(['https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Ampera_Bridge_at_Night.jpg/1200px-Ampera_Bridge_at_Night.jpg']), 'latitude' => -2.991196, 'longitude' => 104.763434, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 5. ACCOMMODATIONS (Lebih Banyak Hotel)
        DB::table('accommodations')->insert([
            // BANDUNG
            ['accommodationID' => 1, 'providerID' => 4, 'cityID' => 1, 'hotelName' => 'The Trans Luxury Hotel', 'averagePricePerNight' => 2500000, 'rating' => 5.0, 'type' => 'Hotel', 'facilities' => json_encode(['Kolam Renang', 'Spa', 'Gym']), 'bookingLink' => 'https://thetranshotel.com', 'description' => 'Hotel mewah bintang 6 di Bandung.', 'images' => json_encode(['https://cf.bstatic.com/xdata/images/hotel/max1024x768/12345678.jpg']), 'latitude' => -6.923890, 'longitude' => 107.636750, 'created_at' => now(), 'updated_at' => now()],
            ['accommodationID' => 2, 'providerID' => 100, 'cityID' => 1, 'hotelName' => 'Budgettrip Capsule Hotel Bandung', 'averagePricePerNight' => 95000, 'rating' => 4.2, 'type' => 'Hostel', 'facilities' => json_encode(['WiFi', 'AC', 'Loker']), 'bookingLink' => null, 'description' => 'Hotel kapsul hemat di pusat kota.', 'images' => json_encode(['https://placehold.co/600x400?text=Capsule+Hotel']), 'latitude' => -6.914744, 'longitude' => 107.609810, 'created_at' => now(), 'updated_at' => now()],

            // JOGJA
            ['accommodationID' => 3, 'providerID' => 4, 'cityID' => 4, 'hotelName' => 'Adhistana Hotel Yogyakarta', 'averagePricePerNight' => 450000, 'rating' => 4.5, 'type' => 'Hotel', 'facilities' => json_encode(['WiFi', 'Kolam Renang']), 'bookingLink' => 'https://adhistana.com', 'description' => 'Hotel butik dengan nuansa Jawa modern.', 'images' => json_encode(['https://adhistana.com/wp-content/uploads/2019/01/Pool-Area.jpg']), 'latitude' => -7.818950, 'longitude' => 110.364440, 'created_at' => now(), 'updated_at' => now()],

            // BALI
            ['accommodationID' => 4, 'providerID' => 4, 'cityID' => 5, 'hotelName' => 'Hard Rock Hotel Bali', 'averagePricePerNight' => 1800000, 'rating' => 4.7, 'type' => 'Hotel', 'facilities' => json_encode(['Kolam Renang', 'Bar', 'Musik']), 'bookingLink' => 'https://hardrockhotels.com/bali', 'description' => 'Hotel bertema musik di tepi pantai Kuta.', 'images' => json_encode(['https://lh3.googleusercontent.com/p/AF1QipM5...']), 'latitude' => -8.722638, 'longitude' => 115.169548, 'created_at' => now(), 'updated_at' => now()],

            // PALEMBANG
            ['accommodationID' => 5, 'providerID' => 100, 'cityID' => 2, 'hotelName' => 'Budgettrip Homestay Palembang', 'averagePricePerNight' => 150000, 'rating' => 4.3, 'type' => 'Homestay', 'facilities' => json_encode(['AC', 'Sarapan']), 'bookingLink' => null, 'description' => 'Homestay nyaman dekat jembatan Ampera.', 'images' => json_encode(['https://placehold.co/600x400?text=Homestay+Palembang']), 'latitude' => -2.986873, 'longitude' => 104.762953, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 6. TRANSPORT ROUTES (Rute Lebih Variatif)
        DB::table('transport_routes')->insert([
            // JKT - BDG
            [
                'routeID' => 1,
                'providerID' => 1,
                'originCityID' => 3,
                'destinationCityID' => 1,
                'averagePrice' => 150000,
                'departureTime' => '08:00:00',
                'arrivalTime' => '11:00:00',
                'class' => 'Executive',
                'facilities' => json_encode(['AC', 'Seat Belt']),
                'bookingLink' => 'https://cititrans.co.id',
                'description' => 'Shuttle SCBD ke Dipatiukur.',
                'images' => json_encode(['https://cititrans.co.id/unit.jpg']),
                'start_latitude' => -6.223838,
                'start_longitude' => 106.809835,
                'end_latitude' => -6.894326,
                'end_longitude' => 107.615967,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // JOGJA - JKT
            [
                'routeID' => 2,
                'providerID' => 5,
                'originCityID' => 4,
                'destinationCityID' => 3,
                'averagePrice' => 450000,
                'departureTime' => '20:00:00',
                'arrivalTime' => '04:00:00',
                'class' => 'Eksekutif',
                'facilities' => json_encode(['AC', 'Toilet', 'Makan']),
                'bookingLink' => 'https://kai.id',
                'description' => 'KA Taksaka Malam.',
                'images' => json_encode(['https://kai.id/unit.jpg']),
                'start_latitude' => -7.789178,
                'start_longitude' => 110.363419, // Stasiun Tugu
                'end_latitude' => -6.176662,
                'end_longitude' => 106.830635, // Stasiun Gambir
                'created_at' => now(),
                'updated_at' => now()
            ],
            // BDG - JOGJA (KHUSUS BUDGETTRIP)
            [
                'routeID' => 99,
                'providerID' => 99,
                'originCityID' => 1,
                'destinationCityID' => 4,
                'averagePrice' => 200000,
                'departureTime' => '07:00:00',
                'arrivalTime' => '15:00:00',
                'class' => 'Budgettrip Bus',
                'facilities' => json_encode(['AC', 'Snack']),
                'bookingLink' => null,
                'description' => 'Bus Pariwisata Budgettrip.',
                'images' => json_encode(['https://placehold.co/600x400?text=Bus+Budgettrip']),
                'start_latitude' => -6.912759,
                'start_longitude' => 107.575974, // Terminal Leuwi Panjang
                'end_latitude' => -7.801377,
                'end_longitude' => 110.375253, // Terminal Giwangan
                'created_at' => now(),
                'updated_at' => now()
            ],
            // JKT - BALI (PESAWAT)
            [
                'routeID' => 3,
                'providerID' => 6,
                'originCityID' => 3,
                'destinationCityID' => 5,
                'averagePrice' => 1200000,
                'departureTime' => '10:00:00',
                'arrivalTime' => '13:00:00',
                'class' => 'Ekonomi',
                'facilities' => json_encode(['Bagasi 20KG']),
                'bookingLink' => 'https://lionair.co.id',
                'description' => 'Penerbangan langsung Jakarta - Denpasar.',
                'images' => json_encode(['https://upload.wikimedia.org/wikipedia/commons/5/52/Lion_Air_Boeing_737-900ER.jpg']),
                'start_latitude' => -6.125556,
                'start_longitude' => 106.655833, // Bandara Soetta
                'end_latitude' => -8.748169,
                'end_longitude' => 115.167173, // Bandara Ngurah Rai
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 7. TRAVEL PLANS (Data Dummy untuk Testing)
        DB::table('travel_plans')->insert([
            [
                'planID' => 1,
                'userID' => 1,
                'planName' => 'Liburan ke Palembang',
                'amount' => 2000000,
                'originCityID' => 1,
                'destinationCityID' => 2,
                'accommodationCityID' => 2,
                'startDate' => '2025-12-01',
                'endDate' => '2025-12-05',
                'requestedActivities' => json_encode(['Wisata Kuliner']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'planID' => 2,
                'userID' => 2,
                'planName' => 'Trip Jogja Hemat',
                'amount' => 1500000,
                'originCityID' => 1,
                'destinationCityID' => 4,
                'accommodationCityID' => 4,
                'startDate' => '2025-11-20',
                'endDate' => '2025-11-23',
                'requestedActivities' => json_encode(['Sejarah']),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // 8. ITINERARIES
        DB::table('itineraries')->insert([
            ['itineraryID' => 1, 'planID' => 1, 'itineraryName' => 'Rencana Utama', 'created_at' => now(), 'updated_at' => now()],
            ['itineraryID' => 2, 'planID' => 2, 'itineraryName' => 'Opsi Backpacker', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 9. PLAN ITEMS (Isi item dummy ke rencana)
        DB::table('plan_items')->insert([
            // Rencana 1: Bus Budgettrip (Bisa tes bayar)
            ['planItemID' => 1, 'itineraryID' => 1, 'description' => 'Budgettrip Bus (Executive)', 'itemType' => 'Transportasi', 'estimatedCost' => 200000, 'quantity' => 2, 'bookingLink' => null, 'providerName' => 'Budgettrip Travel', 'latitude' => -6.912759, 'longitude' => 107.575974, 'created_at' => now(), 'updated_at' => now()],

            // Rencana 1: Hotel
            ['planItemID' => 2, 'itineraryID' => 1, 'description' => 'Budgettrip Homestay Palembang', 'itemType' => 'Akomodasi', 'estimatedCost' => 450000, 'quantity' => 3, 'bookingLink' => null, 'providerName' => 'Budgettrip Hotel', 'latitude' => -2.986873, 'longitude' => 104.762953, 'created_at' => now(), 'updated_at' => now()],

            // Rencana 2: Hotel Kapsul
            ['planItemID' => 3, 'itineraryID' => 2, 'description' => 'Budgettrip Capsule Hotel Bandung', 'itemType' => 'Akomodasi', 'estimatedCost' => 190000, 'quantity' => 2, 'bookingLink' => null, 'providerName' => 'Budgettrip Hotel', 'latitude' => -6.914744, 'longitude' => 107.609810, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 10. PROMOTIONS
        DB::table('promotions')->insert([
            ['promotionID' => 1, 'description' => 'Diskon 10% Member Baru', 'discountValue' => 0.10, 'validUntil' => '2025-12-31'],
        ]);
    }
}
