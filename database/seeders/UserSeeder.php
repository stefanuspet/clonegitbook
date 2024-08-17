<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "admin",
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => "user",
                'email' => 'test@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user1",
                'email' => 'user1@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user2",
                'email' => 'user2@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user3",
                'email' => 'user3@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user4",
                'email' => 'user4@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user5",
                'email' => 'user5@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user6",
                'email' => 'user6@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user7",
                'email' => 'user7@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user8",
                'email' => 'user8@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user9",
                'email' => 'user9@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user10",
                'email' => 'user10@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user11",
                'email' => 'user11@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user12",
                'email' => 'user12@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user13",
                'email' => 'user13@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user14",
                'email' => 'user14@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
            [
                'name' => "user15",
                'email' => 'user15@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('test'),
            ],
        ]);
    }
}
