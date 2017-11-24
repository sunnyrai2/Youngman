<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = [
          [
              'type' => 'warehouse',
              'location_name' => 'Kolkata',
              'address' => 'Address',
              'state_code' => '3'
          ],
          [
              'type' => 'warehouse',
              'location_name' => 'Hyderabad',
              'address' => 'Address',
              'state_code' => '28'
          ],
          [
              'type' => 'warehouse',
              'location_name' => 'Mumbai',
              'address' => 'Address',
              'state_code' => '29'
          ],
          [
              'type' => 'warehouse',
              'location_name' => 'Chennai',
              'address' => 'Address',
              'state_code' => '1'
          ],
          [
              'type' => 'warehouse',
              'location_name' => 'Bangalore',
              'address' => 'Address',
              'state_code' => '2'
          ],
          [
              'type' => 'warehouse',
              'location_name' => 'Ahmedabad',
              'address' => 'Address',
              'state_code' => '3'
          ],

        ];
    }
}
