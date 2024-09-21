<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'オーナー',
                'email' => 'owner@test.com',
            ],
            [
                'name' => 'まちづくり推進課',
                'email' => 'town-management@test.com',
            ],
        ]);
    }
}
