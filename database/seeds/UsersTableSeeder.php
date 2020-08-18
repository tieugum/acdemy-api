<?php

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Instructor',
            'role' => 'instructor',
            'email' => 'instructor@email.com',
            'password' => bcrypt('instructor123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'User',
            'role' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('user123'),
            'email_verified_at' => now(),
        ]);
    }
}
