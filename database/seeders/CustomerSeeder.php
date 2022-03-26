<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::insert([
            [
                'name' => 'Bryce Wyne',
                'email' => 'bruce@wyne-enterprice.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Clark Kent',
                'email' => 'clart.kent@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lois Lane',
                'email' => 'Lois.lane@dailyplanet.net',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hal Jordan',
                'email' => 'hal.jordan@oa.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Guy Gardner',
                'email' => 'guy.gardner@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
