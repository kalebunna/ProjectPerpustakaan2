<?php

namespace Database\Seeders;

use App\Models\Identitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Identitas::create([
            "nama_sekolah" => "Sekolah Bina Bangsa",
            "nama_aplikasi" => "SBS",
            "alamat" => "JL. KH. Manshur NO. 12 GG 15",
            "tahun_ajaran" => "2022-2023",
            "logo" => "logos",
            "denda" => "20000",
        ]);
    }
}
