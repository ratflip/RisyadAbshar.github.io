<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil MenuSeeder yang baru dibuat
        $this->call([
            MenuSeeder::class,
            AdminSeeder::class,
            // Jika ada seeder lain (seperti MenuSeeder dll), taruh di bawahnya sini
        ]);
    }
}