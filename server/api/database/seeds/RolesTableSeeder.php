<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'root',
            'label' => 'Super Admin',
            'permissions' => '["+*"]'
        ]);
        Role::create([
            'name' => 'admin',
            'label' => 'Administrador',
            'permissions' => '[
                "+poll.create",
                "+poll.clone",
                "+poll.open",
                "+poll.close",
                "+poll.showMap",
                "+necessity.create",
                "+voting.download",
                "+voting.syncNotification"
            ]'
        ]);
        Role::create([
            'name' => 'facilitador',
            'label' => 'Facilitador',
            'permissions' => '[
                "+poll.sync",
                "+poll.list",
                "+voting.sync",
                "+voting.create",
                "+voting.list",
                "+voting.open",
                "+voting.close",
                "+voting.show",
                "+necessity.create",
                "+necessity.enable",
                "+necessity.disable",
                "+necessity.delete",
                "+necessityVote.setCount"
            ]'
        ]);
    }
}
