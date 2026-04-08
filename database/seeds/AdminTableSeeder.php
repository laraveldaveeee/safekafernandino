<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Admin;
use Carbon\Carbon;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::firstOrCreate([
            'name'  => 'Administrator', 
            'email' => 'admin@example.com',
            'gender' => 'Male',
            'mobile' => 63993423029,
            'language' => 'FIL',
            'birthdate' => Carbon::now(),
            'address' => 'San Fernando Pampanga'
        ]);

        $user = User::firstOrCreate([
            'role_id' => 1,
            'guardian_id' => 0,
            'rescuer_id' => 0,
            'admin_id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'status' => 'confirmed',
            'password' => bcrypt('123456789')
        ]);
    }
}