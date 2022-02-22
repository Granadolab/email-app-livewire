<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;


class StateSeeder extends Seeder
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
                'name'=>'DTTO CAPITAL',
                'country_id'=>1
            ],
            [
                'name'=>'CARABOBO',
                'country_id'=>1
            ],
            [
                'name'=>'AMAZONAS',
                'country_id'=>1
            ],
            [
                'name'=>'TÁCHIRA',
                'country_id'=>1
            ],
            [
                'name'=>'MONAGAS',
                'country_id'=>1
            ]

        ]);



        foreach ($data as $key) {
            State::create([
                'name'=>$key['name'],
                'country_id'=>$key['country_id']
            ]);
        }
    }
}
