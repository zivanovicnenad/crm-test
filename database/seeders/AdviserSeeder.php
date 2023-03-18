<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 100; $i++) {
            User::factory()->create();
        }
    }
}

