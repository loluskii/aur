<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fname' => 'Wale',
            'lname' => 'Olokunola',
            'email' => 'olawale@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' =>  1,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
        ]);

    }
}
