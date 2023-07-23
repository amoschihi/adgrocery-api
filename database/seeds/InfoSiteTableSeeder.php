<?php

use Illuminate\Database\Seeder;
use App\Models\InfoSite;

class InfoSiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InfoSite::create(array(
            'tel' => '+1 205 902 292',
            'name' => 'A&D GROCERY',
            'fax' => '+1 205 902 292',
            'address' => 'Sioux Falls, South Dakota',
            'serviceStart' => '08:00 AM',
            'serviceEnd' => '6:00 PM',
            'email' => 'info@adgrocery.com',
            'x' => '43.545854840088666',
            'y' => '-96.73085511741644'
        ));
    }
}
