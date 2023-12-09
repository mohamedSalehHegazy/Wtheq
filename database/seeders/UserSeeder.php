<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // normal user
        User::firstOrCreate(
            [
                'username' => 'mohamedNormalUser',
            ],
            [
                'name' => 'Mohamed 1',
                'username' => 'mohamedNormalUser',
                'password' => bcrypt('12345678'),
                'type' => 1,
            ]
        );

        // silver user
        User::firstOrCreate(
            [
                'username' => 'mohamedSilverUser',
            ],
            [
                'name' => 'Mohamed 2',
                'username' => 'mohamedSilverUser',
                'password' => bcrypt('12345678'),
                'type' => 2,
            ]
        );

        // golden user
        User::firstOrCreate(
            [
                'username' => 'mohamedGoldenUser',
            ],
            [
                'name' => 'Mohamed 3',
                'username' => 'mohamedGoldenUser',
                'password' => bcrypt('12345678'),
                'type' => 3,
            ]
        );
    }
}
