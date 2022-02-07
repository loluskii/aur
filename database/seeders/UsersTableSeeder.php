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
        
        User::create([
            'fname' => 'Wal2wwse',
            'lname' => 'Oloklhgkjcghunola',
            'email' => 'text@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeek(),
        ]);
        
        User::create([
            'fname' => 'Wale',
            'lname' => 'Olokujhtxfcgnola',
            'email' => 'just_there@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeeks(1),
        ]);
        
        User::create([
            'fname' => 'Waghhghghgle',
            'lname' => 'Olkihgjyokunola',
            'email' => 'rexc@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeeks(1),
        ]);
        User::create([
            'fname' => 'Wale',
            'lname' => 'Olodysydtydtykunola',
            'email' => 'leemao@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeeks(1),
        ]);
        User::create([
            'fname' => 'Wale000',
            'lname' => 'Olojkiuvytcrsrakunola',
            'email' => 'mokih@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeeks(1),
        ]);
        User::create([
            'fname' => 'Wa0bu8le',
            'lname' => 'Olokjhkunola',
            'email' => 'dffghj@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeeks(1),
        ]);
        User::create([
            'fname' => 'Wa4565le',
            'lname' => 'Olojklopkunola',
            'email' => 'hguygvbkjg@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeeks(1),
        ]);
        User::create([
            'fname' => 'Wajkble',
            'lname' => 'Olgfsokunola',
            'email' => 'olahvuyvuywale@aur2611.store',
            'email_verified_at' => now(),
            'is_admin' => 0,
            'password' => Hash::make('aur2611'), // aur2611
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->subWeeks(1),
        ]);
    }
}
