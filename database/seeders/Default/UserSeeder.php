<?php

namespace Database\Seeders\Default;

use App\Models\Default\User;
use App\Zaions\Enums\RolesEnum;
use App\Zaions\Helpers\ZSeederHelpers;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    static function run(): void
    {
        // Get/Create roles
        $superAdminRole = ZSeederHelpers::getRole(RolesEnum::superAdmin);
        $adminRole = ZSeederHelpers::getRole(RolesEnum::admin);
        $userRole = ZSeederHelpers::getRole(RolesEnum::user);
        $buyerRole = ZSeederHelpers::getRole(RolesEnum::buyer);
        $sellerRole = ZSeederHelpers::getRole(RolesEnum::seller);
        $buyerSellerRole = ZSeederHelpers::getRole(RolesEnum::buyerSeller);

        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => env('SUPER_ADMIN_EMAIL', 'tester@zaions.com')],
            [
                'unique_id' => uniqid(),
                'username' => 'aoneahsan',
                'name' => 'Ahsan Mahmood',
                'password' => Hash::make("Asd123!@#"),
                'email_verified_at' => Carbon::now(),
                'phone_number' => "03046619706",
                'country_code' => "92",
                'country_code_text' => "pk",
                'location' => "lahore, pakistan",
                // 'role' => "developer",
                'profile_publicly_visible' => "visible",
                'address' => "lahore, pakistan",
                'country' => "Pakistan",
                'state' => "Asia",
                'company' => "Zaions",
                'registration_number' => "123",
                'city' => "Lahore",
                'zipcode' => "54000",
                'vat_number' => "10",
                'default_currency' => "USD",
                'notes' => "Thanks for your business.",
                'bank_details' => "Account Title: Ahsan Mahmood, Account Email: " . env('SUPER_ADMIN_EMAIL', 'tester@zaions.com')
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'unique_id' => uniqid(),
                'username' => 'admin',
                'name' => 'Admin',
                'password' => Hash::make("Asd123!@#"),
                'email_verified_at' => Carbon::now(),
                'phone_number' => "03046619706",
                'country_code' => "92",
                'country_code_text' => "pk",
                'location' => "lahore, pakistan",
                // 'role' => "developer",
                'profile_publicly_visible' => "visible",
                'address' => "lahore, pakistan",
                'country' => "Pakistan",
                'state' => "Asia",
                'company' => "Zaions",
                'registration_number' => "123",
                'city' => "Lahore",
                'zipcode' => "54000",
                'vat_number' => "10",
                'default_currency' => "USD",
                'notes' => "Thanks for your business.",
                'bank_details' => "Account Title: admin, Account Email: admin@gmail.com"
            ]
        );
        $admin->assignRole($adminRole);

        // User
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'unique_id' => uniqid(),
                'username' => 'user',
                'name' => 'User',
                'password' => Hash::make("Asd123!@#"),
                'email_verified_at' => Carbon::now(),
                'phone_number' => "03046619706",
                'country_code' => "92",
                'country_code_text' => "pk",
                'location' => "lahore, pakistan",
                // 'role' => "developer",
                'profile_publicly_visible' => "visible",
                'address' => "lahore, pakistan",
                'country' => "Pakistan",
                'state' => "Asia",
                'company' => "Zaions",
                'registration_number' => "123",
                'city' => "Lahore",
                'zipcode' => "54000",
                'vat_number' => "10",
                'default_currency' => "USD",
                'notes' => "Thanks for your business.",
                'bank_details' => "Account Title: user, Account Email: user@gmail.com"
            ]
        );
        $user->assignRole($userRole);

        // Buyer
        $buyer = User::firstOrCreate(
            ['email' => 'buyer@gmail.com'],
            [
                'unique_id' => uniqid(),
                'username' => 'buyer',
                'name' => 'Buyer',
                'password' => Hash::make("Asd123!@#"),
                'email_verified_at' => Carbon::now(),
                'phone_number' => "03046619706",
                'country_code' => "92",
                'country_code_text' => "pk",
                'location' => "lahore, pakistan",
                // 'role' => "developer",
                'profile_publicly_visible' => "visible",
                'address' => "lahore, pakistan",
                'country' => "Pakistan",
                'state' => "Asia",
                'company' => "Zaions",
                'registration_number' => "123",
                'city' => "Lahore",
                'zipcode' => "54000",
                'vat_number' => "10",
                'default_currency' => "USD",
                'notes' => "Thanks for your business.",
                'bank_details' => "Account Title: buyer, Account Email: buyer@gmail.com"
            ]
        );
        $buyer->assignRole($buyerRole);

        // Seller
        $seller = User::firstOrCreate(
            ['email' => 'seller@gmail.com'],
            [
                'unique_id' => uniqid(),
                'username' => 'seller',
                'name' => 'Seller',
                'password' => Hash::make("Asd123!@#"),
                'email_verified_at' => Carbon::now(),
                'phone_number' => "03046619706",
                'country_code' => "92",
                'country_code_text' => "pk",
                'location' => "lahore, pakistan",
                // 'role' => "developer",
                'profile_publicly_visible' => "visible",
                'address' => "lahore, pakistan",
                'country' => "Pakistan",
                'state' => "Asia",
                'company' => "Zaions",
                'registration_number' => "123",
                'city' => "Lahore",
                'zipcode' => "54000",
                'vat_number' => "10",
                'default_currency' => "USD",
                'notes' => "Thanks for your business.",
                'bank_details' => "Account Title: seller, Account Email: seller@gmail.com"
            ]
        );
        $seller->assignRole($sellerRole);

        // BuyerSeller
        $buyerSeller = User::firstOrCreate(
            ['email' => 'buyerSeller@gmail.com'],
            [
                'unique_id' => uniqid(),
                'username' => 'buyerSeller',
                'name' => 'BuyerSeller',
                'password' => Hash::make("Asd123!@#"),
                'email_verified_at' => Carbon::now(),
                'phone_number' => "03046619706",
                'country_code' => "92",
                'country_code_text' => "pk",
                'location' => "lahore, pakistan",
                // 'role' => "developer",
                'profile_publicly_visible' => "visible",
                'address' => "lahore, pakistan",
                'country' => "Pakistan",
                'state' => "Asia",
                'company' => "Zaions",
                'registration_number' => "123",
                'city' => "Lahore",
                'zipcode' => "54000",
                'vat_number' => "10",
                'default_currency' => "USD",
                'notes' => "Thanks for your business.",
                'bank_details' => "Account Title: buyerSeller, Account Email: buyerSeller@gmail.com"
            ]
        );
        $buyerSeller->assignRole($buyerSellerRole);
    }
}
