<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $region = new Region();
        $region->name = 'United States';
        $region->save();
    }
}
