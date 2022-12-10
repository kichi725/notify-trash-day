<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('trash')->insert([
            [
                'code' => '01',
                'name' => '燃えるごみ',
            ],
            [
                'code' => '02',
                'name' => '燃えないごみ',
            ],
            [
                'code' => '03',
                'name' => '資源ごみ',
            ]
        ]);
    }
}
