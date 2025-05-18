<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Industri;

class IndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industris = Industri::insert([
            [
                'logo' => 'logos/aksa.jpeg',
                'nama' => 'PT Aksa Digital Group', 
                'bidang_usaha' => 'IT Service and IT Consulting (Information Technology Company)',
                'alamat' => 'Jl. Wongso Permono No.26, Klidon, Sukoharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',
                'kontak' => '08982909000',
                'email' => 'aksa@gmail.com',
                'website' => 'https://aksa.id/',
            ],
            [
                'logo' => 'logos/aksa.png',
                'nama' => 'PT. Gamatechno Indonesia', 
                'bidang_usaha' => 'Penyedia layanan, solusi, dan produk inovasi teknologi informasi serta holding company yang melahirkan startup di bidang teknologi informasi.',
                'alamat' => 'Jl. Purwomartani, Karangmojo, Purwomartani, Kec. Kalasan, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'kontak' => '0274-5044044',
                'email' => 'info@gamatechno.com',
                'website' => 'https://www.gamatechno.com/',
            ],
            [
                'logo' => 'logos/aksa.png',
                'nama' => 'CV. Karya Hidup Sentosa ', 
                'bidang_usaha' => 'Alat pertanian',
                'alamat' => 'JJl. Magelang KM.8,8, Jongke Tengah, Sendangadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55285',
                'kontak' => '0274-512095',
                'email' => 'quick@gmail.com',
                'website' => 'https://www.quick.co.id/',
            ],
        ]);
    }
}
