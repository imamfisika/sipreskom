<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Muhammad Izzat Azizan',
            'nim' => '1313621013',
            'email' => 'muhammadizzatazizan_1313621013@mhs.unj.ac.id',
            'password' => bcrypt('password'), // password
            // 'foto' => '/storage/foto/Lk90dTXZnpsyIy6hzERuq9tQD2aGBLmPhavDbJjb.jpg',

        ]);
    }
}
