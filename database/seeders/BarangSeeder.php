<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barangs')->insert([
            [
                'kodeBarang' => 'SP',
                'namaBarang' => 'SamPoerna',
                'deskripsiBarang'=> 'SamPoerna',
                'hargaBarang' => 25000,
                'satuan_id' => 1
                ],
                [
                'kodeBarang' => 'GB',
                'namaBarang' => 'Gajah Baru',
                'deskripsiBarang'=> 'Gajah Baru',
                'hargaBarang' => 20000,
                'satuan_id' => 1
                ],
        ]);
    }
}
