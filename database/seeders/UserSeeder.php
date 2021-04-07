<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User\Client;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->user_uniqid = uniqid();
        $user->username = "aoneahsan";
        $user->name = "Ahsan Mahmood";
        $user->email = "aoneahsan@gmail.com";
        $user->password = Hash::make("123123");
        $user->email_verified_at = Carbon::now();
        $user->phone_number = "03046619706";
        $user->country_code = "92";
        $user->country_code_text = "pk";
        $user->location = "lahore, pakistan";
        $user->role = "developer";
        $user->profile_publicly_visible = "visible";
        $user->address = "lahore, pakistan";
        $user->country = "Pakistan";
        $user->state = "Asia";
        $user->company = "Zaions";
        $user->company_registration_number = "123";
        $user->city = "Lahore";
        $user->zipcode = "54000";
        $user->vat_number = "10";
        $user->default_currency = "USD";
        $user->logo = "username";
        $user->notes = "Thanks for your business.";
        $user->bank_details = "Account Title: Ahsan Mahmood, Account Email: aoneahsan@gmail.com";
        $user->save();

        $client = new Client();
        $client->user_id = $user->id;
        $client->name = "Clieny";
        $client->email = "Clieny@demo.com";
        $client->phone_number = "03000000000";
        $client->address = "Lasdkj,asd asd";
        $client->country = "USA";
        $client->company = "Asdlasd";
        $client->company_registration_number = "123";
        $client->city = "Lahore";
        $client->zipcode = "54000";
        $client->vat_number = "10";
        $client->default_currency = "USD";
        $client->notes = "";
        $client->bank_details = "";
        $client->save();
    }
}
