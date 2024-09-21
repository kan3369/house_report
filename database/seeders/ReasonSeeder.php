<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reasons')->insert([
            ['name' => 'オーナーとのトラブル'],
            ['name' => '建物の倒壊'],
            ['name' => '維持管理を保留'],
        ]);
    }
}
