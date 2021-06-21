<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['subject' => 'English']);
        Subject::create(['subject' => 'Gujarati']);
        Subject::create(['subject' => 'Hindi']);
        Subject::create(['subject' => 'Sanskrit']);
        Subject::create(['subject' => 'Maths']);
    }
}
