<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. USERS (Data asli dari SQL Dump)
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Fajril Ikhsan', 'email' => 'fajril@example.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567890', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Damar Wahyu', 'email' => 'damar@example.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567891', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'M Dani Riadi', 'email' => 'dani@example.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567892', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Muhammad Haris', 'email' => 'haris@example.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567893', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Budi Santoso', 'email' => 'budi@example.com', 'password' => Hash::make('password'), 'phoneNumber' => '081234567894', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. CITIES (Data SQL + Tambahan Surabaya, Bali, Lombok, Jogja)
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
        ]);

        // 4. TRANSPORT ROUTES
        DB::table('transport_routes')->insert([
            ['routeID' => 1, 'providerID' => 1, 'originCityID' => 1, 'destinationCityID' => 5, 'averagePrice' => 250000.00, 'bookingLink' => 'https://cititrans.co.id'],
            ['routeID' => 2, 'providerID' => 2, 'originCityID' => 1, 'destinationCityID' => 2, 'averagePrice' => 700000.00, 'bookingLink' => 'https://als.co.id'],
            ['routeID' => 3, 'providerID' => 3, 'originCityID' => 3, 'destinationCityID' => 4, 'averagePrice' => 80000.00, 'bookingLink' => 'https://asdp.co.id'],
            ['routeID' => 4, 'providerID' => 5, 'originCityID' => 1, 'destinationCityID' => 3, 'averagePrice' => 150000.00, 'bookingLink' => 'https://damri.co.id'],
            ['routeID' => 5, 'providerID' => 2, 'originCityID' => 4, 'destinationCityID' => 2, 'averagePrice' => 350000.00, 'bookingLink' => 'https://als.co.id'],
        ]);

        // 5. ACCOMMODATIONS
        DB::table('accommodations')->insert([
            ['accommodationID' => 1, 'providerID' => 4, 'cityID' => 2, 'hotelName' => 'Hotel Batiqa Palembang', 'averagePricePerNight' => 550000.00, 'bookingLink' => 'https://booking.com/batiqa'],
            ['accommodationID' => 2, 'providerID' => 4, 'cityID' => 1, 'hotelName' => 'Ibis Hotel Bandung', 'averagePricePerNight' => 600000.00, 'bookingLink' => 'https://booking.com/ibis'],
            ['accommodationID' => 3, 'providerID' => 4, 'cityID' => 2, 'hotelName' => 'The Arista Hotel Palembang', 'averagePricePerNight' => 1200000.00, 'bookingLink' => 'https://booking.com/arista'],
            ['accommodationID' => 4, 'providerID' => 4, 'cityID' => 1, 'hotelName' => 'GH Universal Bandung', 'averagePricePerNight' => 1100000.00, 'bookingLink' => 'https://booking.com/gh'],
            ['accommodationID' => 5, 'providerID' => 4, 'cityID' => 5, 'hotelName' => 'Hotel Indonesia Kempinski', 'averagePricePerNight' => 2500000.00, 'bookingLink' => 'https://booking.com/kempinski'],
        ]);

        // 6. ATTRACTIONS
        DB::table('attractions')->insert([
            ['attractionID' => 1, 'cityID' => 2, 'attractionName' => 'Jembatan Ampera', 'category' => 'Landmark', 'estimatedCost' => 0.00],
            ['attractionID' => 2, 'cityID' => 2, 'attractionName' => 'Pulau Kemaro', 'category' => 'Wisata Religi', 'estimatedCost' => 15000.00],
            ['attractionID' => 3, 'cityID' => 1, 'attractionName' => 'Gedung Sate', 'category' => 'Landmark', 'estimatedCost' => 5000.00],
            ['attractionID' => 4, 'cityID' => 1, 'attractionName' => 'Kawah Putih', 'category' => 'Wisata Alam', 'estimatedCost' => 75000.00],
            ['attractionID' => 5, 'cityID' => 5, 'attractionName' => 'Monumen Nasional', 'category' => 'Landmark', 'estimatedCost' => 20000.00],
        ]);

        // 7. PROMOTIONS
        DB::table('promotions')->insert([
            ['promotionID' => 1, 'description' => 'Diskon 10% Bus Antar Pulau', 'discountValue' => 0.10, 'validUntil' => '2025-12-31'],
            ['promotionID' => 2, 'description' => 'Promo Hotel Palembang', 'discountValue' => 0.15, 'validUntil' => '2025-11-30'],
            ['promotionID' => 3, 'description' => 'Cashback 5% Travel', 'discountValue' => 0.05, 'validUntil' => '2025-12-01'],
        ]);

        // 8. TRAVEL PLANS (GABUNGAN DARI SQL LAMA)
        DB::table('travel_plans')->insert([
            [
                'planID' => 1,
                'userID' => 1, // Fajril
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
                'userID' => 2, // Damar
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
            [
                'planID' => 3,
                'userID' => 3, // Dani
                'planName' => 'Dinas ke Bandung',
                'amount' => 2500000.00,
                'originCityID' => 5,
                'destinationCityID' => 1,
                'accommodationCityID' => 1,
                'startDate' => '2025-12-10',
                'endDate' => '2025-12-12',
                'requestedActivities' => json_encode(['Belanja']),
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
            ['planItemID' => 1, 'itineraryID' => 1, 'description' => 'Bus ALS', 'itemType' => 'Transportasi', 'estimatedCost' => 700000.00, 'bookingLink' => 'https://als.co.id', 'providerName' => 'Bus ALS', 'created_at' => now(), 'updated_at' => now()],
            ['planItemID' => 2, 'itineraryID' => 1, 'description' => 'Hotel Batiqa', 'itemType' => 'Akomodasi', 'estimatedCost' => 1650000.00, 'bookingLink' => 'https://booking.com', 'providerName' => 'Booking.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}