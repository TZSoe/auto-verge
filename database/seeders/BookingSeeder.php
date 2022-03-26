<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = [
            [
                "date" => "23/12/2020",
                "customer_id" => 1,
                "car_number" => "7I/7654",
                "duration" => 3,
                "notes" => "Keep my car in building B",
                "services" => [
                    1,2,4
                ]
            ],
            [
                "date" => "23/12/2020",
                "customer_id" => 2,
                "car_number" => "3G/8812",
                "duration" => 1,
                "notes" => "Stay away from green stone",
                "services" => [
                    1
                ]
            ],
            [
                "date" => "25/12/2020",
                "customer_id" => 3,
                "car_number" => "1M/9956",
                "duration" => 5,
                "notes" => "Do not move newspapers in trunk",
                "services" => [
                    1,2
                ]
            ],
            [
                "date" => "26/12/2020",
                "customer_id" => 4,
                "car_number" => "9A/6674",
                "duration" => 2,
                "services" => [
                    1
                ]
            ],
            [
                "date" => "30/12/2020",
                "customer_id" => 5,
                "car_number" => "5H/4534",
                "duration" => 7,
                "notes" => "Charge my lantern",
                "services" => [
                    1,3,5
                ]
            ]
        ];

        foreach($bookings as $booking){
            $newBooking = \App\Models\Booking::create([
                'date' => \Illuminate\Support\Carbon::createFromFormat('d/m/Y', $booking['date'])->format("Y-m-d"),
                'customer_id' => $booking['customer_id'],
                'car_number' => $booking['car_number'],
                'duration' => $booking['duration'],
                'notes' => isset($booking['notes']) ? $booking['notes'] : null,
            ]);

            $newBooking->services()->sync($booking['services']);
        }
    }
}
