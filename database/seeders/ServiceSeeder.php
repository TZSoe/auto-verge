<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['type' => 'Basic'],
            ['type' => 'Car Wash'],
            ['type' => 'Daily Car Wash'],
            ['type' => 'Premium Polish'],
            ['type' => 'Charge Battery'],
            ['type' => 'Car Repair']
        ];

        foreach($services as $service){
            Service::create($service);
        }
    }
}
