<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PersonalAccessTokenSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CustomerSeeder::class);

        $this->call(BookingSeeder::class);
    }
}
