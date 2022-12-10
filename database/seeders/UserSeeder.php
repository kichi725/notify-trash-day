<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Users\User;
use App\Models\Weeks\Friday;
use App\Models\Weeks\Monday;
use App\Models\Weeks\Saturday;
use App\Models\Weeks\Sunday;
use App\Models\Weeks\Thursday;
use App\Models\Weeks\Tuesday;
use App\Models\Weeks\Wednesday;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user_id = 'line123';

        User::create([
            'name'    => 'テスト太郎',
            'user_id' => $user_id,
        ]);

        Monday::create([
            'user_id' => $user_id,
            'trash'   => '01',
        ]);

        Tuesday::create([
            'user_id' => $user_id,
            'trash'   => '02',
        ]);

        Wednesday::create([
            'user_id' => $user_id,
            'trash'   => '03',
        ]);

        // Thursday::create([
        //     'user_id' => $user_id,
        //     'trash'   => null,
        // ]);

        Friday::create([
            'user_id' => $user_id,
            'trash'   => '01',
        ]);

        Saturday::create([
            'user_id' => $user_id,
            'trash'   => '02',
        ]);

        // Sunday::create([
        //     'user_id' => $user_id,
        //     'trash'   => null,
        // ]);
    }
}
