<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  saatu seeder bisa membuat banyak table
        // membuat role admin
        $roleAdmin = Role::create([
          'name' => 'admin',
          'display_name' => 'Admin'
        ]);

        // membuat role member
        $roleMember = Role::create([
          'name' => 'member',
          'display_name' => 'Member'
        ]);

        // conteh user dengan role admin
        $adminUser = User::create([
          'name' => 'Admin Tamvan',
          'email' => 'admin@mail.com',
          'password' => bcrypt('123456'),
          'is_verified' => 1
        ]);

        $adminUser->attachRole($roleAdmin);

        // conteh user dengan role member
        $memberUser = User::create([
          'name' => 'Member Tamvan',
          'email' => 'member@mail.com',
          'password' => bcrypt('123456'),
          'is_verified' => 1
        ]);

        $memberUser->attachRole($roleMember);
    }
}
