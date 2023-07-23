<?php

use App\Models\Address;
use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Models\Profile;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_client = Role::where('name', 'client')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $profile = new Profile();
        $profile->type = 'client';
        $client = new User();
        $client->name = 'client Name';
        $client->email = 'client@example.com';
        $client->password = '0000';//bcrypt('0000');
        $client->save();
        $client->roles()->attach($role_client);
        $client->profile()->save($profile);
        $adresse = new Address();
        $adresse->type = 'pro';
        $adresse2 = new Address();
        $adresse2->type = 'per';
        $profile = $client->profile()->first();
        $profile->addresses()->save($adresse);
        $profile->addresses()->save($adresse2);

        $profile2 = new Profile();
        $profile2->type = 'admin';
        $admin = new User();
        $admin->name = 'admin Name';
        $admin->email = 'admin@example.com';
        $admin->password = '0000';//bcrypt('0000');
        $admin->save();
        $admin->roles()->attach($role_admin);
        $admin->profile()->save($profile2);
        $adresse = new Address();
        $adresse->type = 'pro';
        $adresse2 = new Address();
        $adresse2->type = 'per';
        $profile = $admin->profile()->first();
        $profile->addresses()->save($adresse);
        $profile->addresses()->save($adresse2);
    }
}
