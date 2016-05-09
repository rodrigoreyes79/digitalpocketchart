<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "firstname" => "Admin",
            "lastname" => "Diakonie",
            "email" => "diakonieadmin@mailinator.com",
            "password" => Hash::make('test123'),
            "role_id" => 2,
            "org_id" => 1,
            "expired_password" => true
        ]);
    }
}
