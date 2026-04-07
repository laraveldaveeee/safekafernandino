<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $role = Role::firstOrCreate([
            'name'  => 'ADMINISTRATOR',
        ]);

        $role = Role::firstOrCreate([
            'name'  => 'POLICE',
         ]);
        $role = Role::firstOrCreate([
            'name'  => 'AMBULANCE',
         ]);

         $role = Role::firstOrCreate([
            'name'  => 'FIREFIGHTER',
         ]);

         $role = Role::firstOrCreate([
            'name'  => 'GUARDIAN',
         ]);
    }
}
