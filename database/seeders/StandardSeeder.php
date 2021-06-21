<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Standard;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Standard::create(['standard' => '1']);
        Standard::create(['standard' => '2']);
        Standard::create(['standard' => '3']);
        Standard::create(['standard' => '4']);
        Standard::create(['standard' => '5']);
        Standard::create(['standard' => '6']);
        Standard::create(['standard' => '7']);
        Standard::create(['standard' => '8']);
        Standard::create(['standard' => '9']);
        Standard::create(['standard' => '10']);
    }
}
