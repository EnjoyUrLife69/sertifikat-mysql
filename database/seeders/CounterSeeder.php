<?php

namespace Database\Seeders;

use App\Models\Counter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CounterSeeder extends Seeder
{
    public function run()
    {
        Counter::insert([
            [
                'id' => (string) Str::uuid(),
                'type' => 'frontend',
                'count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => (string) Str::uuid(),
                'type' => 'check_certificate',
                'count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
