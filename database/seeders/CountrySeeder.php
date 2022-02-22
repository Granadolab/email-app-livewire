<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;



class CountrySeeder extends Seeder
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
                'name'=>'VENEZUELA'
            ],
            [
                'name'=>'ESPAÑA'
            ],
            [
                'name'=>'CHILE'
            ],
            [
                'name'=>'COLOMBIA'
            ],
        ]);



        foreach ($data as $key) {
            Country::create([
                'name'=>$key['name']
            ]);
        }
    }
}
