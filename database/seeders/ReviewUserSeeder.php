<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'name' => 'John Doe',
                'comment' => 'Great place to play badminton!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'comment' => 'Courts are well-maintained and clean.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Brown',
                'comment' => 'Friendly staff and excellent facilities.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
