<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create for each comment 20 replies
        $replies = Comment::factory(state: [
            'parent_id' => Comment::all()->random()->id,
        ])->count(20)->make();
        
    }
}
