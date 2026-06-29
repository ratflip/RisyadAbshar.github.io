<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama dengan username 'admin' jika ada agar tidak duplikat atau bentrok
        User::where('username', 'admin')->delete();

        // Membuat akun admin dengan menyertakan email wajib database
        User::create([
            'username' => 'admin',
            'email'    => 'admin@cateringyuk.com', // 👈 Kolom ini wajib diisi sesuai aturan database Anda
            'password' => Hash::make('admin123'),  // 🔒 Di-hash aman dengan Bcrypt
            'role'     => 'admin',
        ]);

        $this->command->info('Akun Admin berhasil dibuat! Username: admin, Password: admin123');
    }
}