<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel menu terlebih dahulu (opsional, hapus jika tidak perlu)
        DB::table('menus')->truncate();

        $menus = [
            // ==========================================
            // KATEGORI: HIGH PROTEIN
            // ==========================================
            [
                'nama'      => 'Grilled Chicken Breast & Quinoa',
                'kategori'  => 'High Protein',
                'deskripsi' => 'Dada ayam panggang tanpa kulit yang kaya protein, disajikan dengan quinoa organik dan brokoli rebus pilihan. Cocok untuk pembentukan otot.',
                'harga'     => 55000,
                'gambar'    => 'https://placehold.co/600x400/1d9e75/white?text=Grilled+Chicken',
                'rating'    => 4.8,
                'label'     => 'Terpopuler',
            ],
            [
                'nama'      => 'Beef Steak & Sweet Potato',
                'kategori'  => 'High Protein',
                'deskripsi' => 'Potongan daging sapi tenderloin panggang dengan pendamping ubi jalar panggang dan asparagus. Nutrisi padat untuk energi maksimal.',
                'harga'     => 75000,
                'gambar'    => 'https://placehold.co/600x400/1d9e75/white?text=Beef+Steak',
                'rating'    => 4.9,
                'label'     => 'Premium',
            ],
            [
                'nama'      => 'Salmon Miso Bake',
                'kategori'  => 'High Protein',
                'deskripsi' => 'Ikan salmon segar panggang dengan saus miso ringan, disajikan bersama edamame dan bayam Jepang.',
                'harga'     => 85000,
                'gambar'    => 'https://placehold.co/600x400/1d9e75/white?text=Salmon+Miso',
                'rating'    => 4.7,
                'label'     => null,
            ],

            // ==========================================
            // KATEGORI: WEIGHT LOSS
            // ==========================================
            [
                'nama'      => 'Caesar Salad Lite & Tofu',
                'kategori'  => 'Weight Loss',
                'deskripsi' => 'Salad sayur segar dengan tahu panggang dan saus caesar rendah kalori buatan sendiri. Defisit kalori jadi lebih lezat.',
                'harga'     => 35000,
                'gambar'    => 'https://placehold.co/600x400/0284c7/white?text=Caesar+Salad',
                'rating'    => 4.6,
                'label'     => 'Promo',
            ],
            [
                'nama'      => 'Zucchini Noodles with Pesto',
                'kategori'  => 'Weight Loss',
                'deskripsi' => 'Mie sehat yang terbuat dari potongan zucchini segar, dicampur dengan saus pesto basil tanpa keju tambahan.',
                'harga'     => 42000,
                'gambar'    => 'https://placehold.co/600x400/0284c7/white?text=Zucchini+Noodles',
                'rating'    => 4.5,
                'label'     => null,
            ],
            [
                'nama'      => 'Clear Chicken Soup & Veggies',
                'kategori'  => 'Weight Loss',
                'deskripsi' => 'Sup ayam bening dengan potongan wortel, seledri, dan jamur. Rendah lemak, menghangatkan, dan sangat mengenyangkan.',
                'harga'     => 30000,
                'gambar'    => 'https://placehold.co/600x400/0284c7/white?text=Chicken+Soup',
                'rating'    => 4.7,
                'label'     => 'Menu Baru',
            ],

            // ==========================================
            // KATEGORI: LOW CARBO
            // ==========================================
            [
                'nama'      => 'Cauliflower Fried Rice',
                'kategori'  => 'Low Carbo',
                'deskripsi' => 'Nasi goreng sehat tanpa nasi! Menggunakan kembang kol yang dicincang halus, dimasak dengan telur dan dada ayam.',
                'harga'     => 45000,
                'gambar'    => 'https://placehold.co/600x400/9333ea/white?text=Cauliflower+Rice',
                'rating'    => 4.8,
                'label'     => 'Terlaris',
            ],
            [
                'nama'      => 'Keto Beef Avocado Bowl',
                'kategori'  => 'Low Carbo',
                'deskripsi' => 'Mangkuk bernutrisi berisi tumis daging sapi cincang, potongan alpukat segar, telur mata sapi, dan tomat ceri.',
                'harga'     => 60000,
                'gambar'    => 'https://placehold.co/600x400/9333ea/white?text=Beef+Avocado',
                'rating'    => 4.9,
                'label'     => null,
            ],
            [
                'nama'      => 'Shirataki Pad Thai',
                'kategori'  => 'Low Carbo',
                'deskripsi' => 'Mie shirataki nol kalori yang dimasak ala Pad Thai dengan udang segar, kacang tumbuk, dan tauge renyah.',
                'harga'     => 50000,
                'gambar'    => 'https://placehold.co/600x400/9333ea/white?text=Shirataki+Pad+Thai',
                'rating'    => 4.8,
                'label'     => 'Rekomendasi',
            ],
        ];

        // Format data sebelum di-insert
        $dataToInsert = [];
        foreach ($menus as $menu) {
            $dataToInsert[] = [
                'nama'       => $menu['nama'],
                'slug'       => Str::slug($menu['nama']), // Generate slug otomatis
                'kategori'   => $menu['kategori'],
                'deskripsi'  => $menu['deskripsi'],
                'harga'      => $menu['harga'],
                'gambar'     => $menu['gambar'],
                'rating'     => $menu['rating'],
                'label'      => $menu['label'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert ke database
        DB::table('menus')->insert($dataToInsert);
    }
}