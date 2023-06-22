<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
        // Dump sample super admin user
        $user = User::firstOrCreate([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin.123')
        ]);

        $user->assignRole('super-admin');
    }
}
