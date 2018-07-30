<?php

use Illuminate\Database\Seeder;

class PoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        [
            'user_id' => '2',
            'start_location' => 'Ganit Softech Pvt. Ltd.',
            'start_longitude' => '77.0353033',
            'start_lattitude' => '28.4657163',
            'end_location' => 'IGI Airport Terminal 3 Metro Station, Indira Gandhi International Airport, New Delhi, Delhi',
            'end_longitude' => '77.0822128',
            'end_lattitude' => '28.5550838',
            'timeframe' => '30 min',
            'preference' => 'all',
            'num_of_poolers' => '3',
            'luggage_capacity' => '10 kg',
            'expected_fare' => '450',
            'per_person_fare' => '150',
            'seats_full' => '1',
        ];
    }
}
