<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Board::factory(100)->create();
    }
}
