<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = collect([
            [
                'name'=>'CARACAS',
                'state_id'=>1
            ],
            [
                'name'=>'VALENCIA',
                'state_id'=>2
            ],
            [
                'name'=>'BARUTA',
                'state_id'=>1
            ],
            [
                'name'=>'SAN DIEGO',
                'state_id'=>2
            ],
            [
                'name'=>'PTO AYACUCHO',
                'state_id'=>3
            ]

        ]);



        foreach ($data as $key) {
            City::create([
                'name'=>$key['name'],
                'state_id'=>$key['state_id']
            ]);
        }
    }
}
