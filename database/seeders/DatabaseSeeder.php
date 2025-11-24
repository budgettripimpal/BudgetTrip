<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SEED USERS (DIPERBAIKI: Tambah 'role')
        DB::table('users')->insert([
            [
                'id' => 1, 
                'name' => 'Fajril Ikhsan', 
                'email' => 'fajril@example.com', 
                'password' => Hash::make('password'), 
                'phoneNumber' => '081234567890', 
                'role' => 'user', // <-- Tambah ini
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 2, 
                'name' => 'Damar Wahyu', 
                'email' => 'damar@example.com', 
                'password' => Hash::make('password'), 
                'phoneNumber' => '081234567891', 
                'role' => 'user', // <-- Tambah ini
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 3, 
                'name' => 'M Dani Riadi', 
                'email' => 'dani@example.com', 
                'password' => Hash::make('password'), 
                'phoneNumber' => '081234567892', 
                'role' => 'user', // <-- Tambah ini
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 4, 
                'name' => 'Muhammad Haris', 
                'email' => 'haris@example.com', 
                'password' => Hash::make('password'), 
                'phoneNumber' => '081234567893', 
                'role' => 'user', // <-- Tambah ini
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 5, 
                'name' => 'Budi Santoso', 
                'email' => 'budi@example.com', 
                'password' => Hash::make('password'), 
                'phoneNumber' => '081234567894', 
                'role' => 'user', // <-- Tambah ini
                'created_at' => now(), 'updated_at' => now()
            ],
            // ADMIN (Yang Anda tambahkan)
            [
                'id' => 99, 
                'name' => 'Admin Ganteng', 
                'email' => 'admin@budgettrip.com', 
                'password' => Hash::make('password'), 
                'phoneNumber' => '081234567899', 
                'role' => 'admin', // <-- Ini penyebab error sebelumnya (karena cuma dia yang punya)
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);

        // 2. CITIES
        DB::table('cities')->insert([
            ['cityID' => 1, 'cityName' => 'Bandung', 'province' => 'Jawa Barat', 'locationType' => 'Kota'],
            ['cityID' => 2, 'cityName' => 'Palembang', 'province' => 'Sumatera Selatan', 'locationType' => 'Kota'],
            ['cityID' => 3, 'cityName' => 'Pelabuhan Merak', 'province' => 'Banten', 'locationType' => 'Pelabuhan'],
            ['cityID' => 4, 'cityName' => 'Pelabuhan Bakauheni', 'province' => 'Lampung', 'locationType' => 'Pelabuhan'],
            ['cityID' => 5, 'cityName' => 'Jakarta', 'province' => 'DKI Jakarta', 'locationType' => 'Kota'],
            ['cityID' => 6, 'cityName' => 'Yogyakarta', 'province' => 'DIY', 'locationType' => 'Kota'],
            ['cityID' => 7, 'cityName' => 'Bali (Denpasar)', 'province' => 'Bali', 'locationType' => 'Kota'],
            ['cityID' => 8, 'cityName' => 'Lombok', 'province' => 'NTB', 'locationType' => 'Kota'],
            ['cityID' => 9, 'cityName' => 'Surabaya', 'province' => 'Jawa Timur', 'locationType' => 'Kota'],
        ]);

        // 3. SERVICE PROVIDERS
        DB::table('service_providers')->insert([
            ['providerID' => 1, 'providerName' => 'Cititrans', 'serviceType' => 'Transportasi'],
            ['providerID' => 2, 'providerName' => 'Bus ALS', 'serviceType' => 'Transportasi'],
            ['providerID' => 3, 'providerName' => 'ASDP Indonesia Ferry', 'serviceType' => 'Transportasi'],
            ['providerID' => 4, 'providerName' => 'Booking.com', 'serviceType' => 'Akomodasi'],
            ['providerID' => 5, 'providerName' => 'Damri', 'serviceType' => 'Transportasi'],
            ['providerID' => 6, 'providerName' => 'PT Kereta Api Indonesia', 'serviceType' => 'Transportasi'],
        ]);

        // 4. TRANSPORT ROUTES
        DB::table('transport_routes')->insert([
            [
                'routeID' => 1, 
                'providerID' => 1, 
                'originCityID' => 1, 
                'destinationCityID' => 5, 
                'averagePrice' => 185000.00, 
                'departureTime' => '08:00:00',
                'arrivalTime' => '11:30:00',
                'class' => 'Executive Shuttle',
                'facilities' => json_encode(['AC', 'Bagasi', 'Wifi']),
                'bookingLink' => 'https://cititrans.co.id/bdg-jkt',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'routeID' => 2, 
                'providerID' => 2, 
                'originCityID' => 1, 
                'destinationCityID' => 2, 
                'averagePrice' => 700000.00, 
                'departureTime' => '10:00:00',
                'arrivalTime' => '06:00:00', 
                'class' => 'VIP',
                'facilities' => json_encode(['AC', 'Bagasi', 'Makanan']),
                'bookingLink' => 'https://als.co.id/bdg-plm',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'routeID' => 3, 
                'providerID' => 3, 
                'originCityID' => 3, 
                'destinationCityID' => 4, 
                'averagePrice' => 80000.00, 
                'departureTime' => '14:00:00',
                'arrivalTime' => '16:00:00',
                'class' => 'Ekonomi',
                'facilities' => json_encode(['Bagasi']),
                'bookingLink' => 'https://asdp.co.id',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'routeID' => 4, 
                'providerID' => 6, 
                'originCityID' => 1, 
                'destinationCityID' => 5, 
                'averagePrice' => 590000.00, 
                'departureTime' => '21:00:00',
                'arrivalTime' => '22:45:00',
                'class' => 'Eksekutif',
                'facilities' => json_encode(['AC', 'Bagasi', 'Makanan', 'Wifi']),
                'bookingLink' => 'https://kai.id',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);

        // 5. ACCOMMODATIONS
        DB::table('accommodations')->insert([
            [
                'accommodationID' => 1, 
                'providerID' => 4, 
                'cityID' => 2, 
                'hotelName' => 'Hotel Batiqa Palembang', 
                'averagePricePerNight' => 550000.00, 
                'rating' => 4.0,
                'type' => 'Hotel',
                'facilities' => json_encode(['WiFi Gratis', 'Sarapan', 'Gym']),
                'bookingLink' => 'https://booking.com/batiqa-plm', 
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'accommodationID' => 2, 
                'providerID' => 4, 
                'cityID' => 1, 
                'hotelName' => 'Ibis Hotel Bandung', 
                'averagePricePerNight' => 600000.00, 
                'rating' => 3.5,
                'type' => 'Hotel',
                'facilities' => json_encode(['WiFi Gratis', 'Sarapan']),
                'bookingLink' => 'https://booking.com/ibis-bdg', 
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'accommodationID' => 3, 
                'providerID' => 4, 
                'cityID' => 2, 
                'hotelName' => 'The Arista Hotel Palembang', 
                'averagePricePerNight' => 1200000.00, 
                'rating' => 5.0,
                'type' => 'Hotel',
                'facilities' => json_encode(['WiFi Gratis', 'Sarapan', 'Kolam Renang', 'Spa', 'Bar']),
                'bookingLink' => 'https://booking.com/arista-plm', 
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'accommodationID' => 4, 
                'providerID' => 4, 
                'cityID' => 1, 
                'hotelName' => 'GH Universal Bandung', 
                'averagePricePerNight' => 1100000.00, 
                'rating' => 5.0,
                'type' => 'Hotel',
                'facilities' => json_encode(['WiFi Gratis', 'Kolam Renang', 'Sarapan', 'Parkir']),
                'bookingLink' => 'https://booking.com/ghuniversal-bdg', 
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'accommodationID' => 5, 
                'providerID' => 4, 
                'cityID' => 5, 
                'hotelName' => 'Hotel Indonesia Kempinski', 
                'averagePricePerNight' => 2500000.00, 
                'rating' => 5.0,
                'type' => 'Hotel',
                'facilities' => json_encode(['WiFi Gratis', 'Kolam Renang', 'Spa', 'Gym', 'Bar']),
                'bookingLink' => 'https://booking.com/kempinski-jkt', 
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'accommodationID' => 6, 
                'providerID' => 4, 
                'cityID' => 7, 
                'hotelName' => 'Bali Villa Ubud', 
                'averagePricePerNight' => 3500000.00, 
                'rating' => 5.0,
                'type' => 'Villa',
                'facilities' => json_encode(['Kolam Renang', 'WiFi Gratis', 'Sarapan']),
                'bookingLink' => 'https://booking.com/bali-villa', 
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);

        // 6. ATTRACTIONS
        DB::table('attractions')->insert([
            [
                'attractionID' => 1, 'cityID' => 1, 
                'attractionName' => 'Kawah Putih', 'category' => 'Alam', 
                'estimatedCost' => 28000.00, 'rating' => 4.7, 'reviewCount' => 1200,
                'description' => 'Danau kawah vulkanik dengan air berwarna putih kehijauan yang memukau. Spot foto favorit.',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'attractionID' => 2, 'cityID' => 1, 
                'attractionName' => 'Museum Geologi', 'category' => 'Sejarah & Budaya', 
                'estimatedCost' => 3000.00, 'rating' => 4.6, 'reviewCount' => 890,
                'description' => 'Museum bersejarah yang menyimpan koleksi fosil, batuan, dan mineral. Edukatif untuk keluarga.',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'attractionID' => 3, 'cityID' => 1, 
                'attractionName' => 'Trans Studio Bandung', 'category' => 'Hiburan', 
                'estimatedCost' => 200000.00, 'rating' => 4.5, 'reviewCount' => 2500,
                'description' => 'Taman hiburan indoor terbesar dengan berbagai wahana seru dan pertunjukan kelas dunia.',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'attractionID' => 4, 'cityID' => 2, 
                'attractionName' => 'Jembatan Ampera', 'category' => 'Landmark', 
                'estimatedCost' => 0.00, 'rating' => 4.8, 'reviewCount' => 3000,
                'description' => 'Ikon kota Palembang yang megah, sangat indah dinikmati saat malam hari dengan lampu-lampu.',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'attractionID' => 5, 'cityID' => 7, 
                'attractionName' => 'Tanah Lot', 'category' => 'Alam', 
                'estimatedCost' => 60000.00, 'rating' => 4.8, 'reviewCount' => 5000,
                'description' => 'Pura ikonik di atas batu karang di tengah laut, terkenal dengan pemandangan sunset yang magis.',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'attractionID' => 6, 'cityID' => 7, 
                'attractionName' => 'Pasar Seni Sukawati', 'category' => 'Belanja', 
                'estimatedCost' => 0.00, 'rating' => 4.4, 'reviewCount' => 1500,
                'description' => 'Pusat belanja oleh-oleh khas Bali, mulai dari lukisan, kerajinan tangan, hingga pakaian.',
                'created_at' => now(), 'updated_at' => now()
            ],
             [
                'attractionID' => 7, 'cityID' => 7, 
                'attractionName' => 'Bebek Tepi Sawah', 'category' => 'Kuliner', 
                'estimatedCost' => 120000.00, 'rating' => 4.6, 'reviewCount' => 2100,
                'description' => 'Restoran legendaris dengan pemandangan sawah hijau dan menu bebek goreng krispi yang nikmat.',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);

        // 7. PROMOTIONS
        DB::table('promotions')->insert([
            ['promotionID' => 1, 'description' => 'Diskon 10% Bus Antar Pulau', 'discountValue' => 0.10, 'validUntil' => '2025-12-31'],
            ['promotionID' => 2, 'description' => 'Promo Hotel Palembang', 'discountValue' => 0.15, 'validUntil' => '2025-11-30'],
            ['promotionID' => 3, 'description' => 'Cashback 5% Travel', 'discountValue' => 0.05, 'validUntil' => '2025-12-01'],
        ]);

        // 8. TRAVEL PLANS
        DB::table('travel_plans')->insert([
            [
                'planID' => 1,
                'userID' => 1, 
                'planName' => 'Perjalanan ke Palembang',
                'amount' => 2000000.00,
                'originCityID' => 1, 
                'destinationCityID' => 2, 
                'accommodationCityID' => 2,
                'startDate' => '2025-12-01',
                'endDate' => '2025-12-05',
                'requestedActivities' => json_encode(['Wisata Kuliner', 'Wisata Sejarah']),
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'planID' => 2,
                'userID' => 2, 
                'planName' => 'Trip ke Merak',
                'amount' => 500000.00,
                'originCityID' => 1,
                'destinationCityID' => 3,
                'accommodationCityID' => null,
                'startDate' => '2025-11-20',
                'endDate' => '2025-11-21',
                'requestedActivities' => null,
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);

        // 9. ITINERARIES
        DB::table('itineraries')->insert([
            ['itineraryID' => 1, 'planID' => 1, 'itineraryName' => 'Rute 1 (Bus Langsung)', 'created_at' => now(), 'updated_at' => now()],
            ['itineraryID' => 2, 'planID' => 1, 'itineraryName' => 'Rute 2 (Bus + Kapal)', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 10. PLAN ITEMS
        DB::table('plan_items')->insert([
            ['planItemID' => 1, 'itineraryID' => 1, 'description' => 'Bus ALS', 'itemType' => 'Transportasi', 'estimatedCost' => 700000.00, 'bookingLink' => 'https://als.co.id/bdg-plm', 'providerName' => 'Bus ALS', 'created_at' => now(), 'updated_at' => now()],
            ['planItemID' => 2, 'itineraryID' => 1, 'description' => 'Hotel Batiqa Palembang', 'itemType' => 'Akomodasi', 'estimatedCost' => 1650000.00, 'bookingLink' => 'https://booking.com/batiqa-plm', 'providerName' => 'Booking.com', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 11. PLAN PROMOTIONS
        DB::table('plan_promotions')->insert([
            ['planID' => 1, 'promotionID' => 1, 'created_at' => now()],
        ]);

        // 12. SHARED PLANS
        DB::table('shared_plans')->insert([
            ['shareID' => 1, 'planID' => 1, 'sharedWith' => 'teman_fajril@example.com', 'method' => 'Email', 'created_at' => now()],
        ]);
    }
}