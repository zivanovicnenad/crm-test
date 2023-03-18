<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Adviser;

class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 100; $i++) {
            Adviser::factory()->create();
        }
    }
}

