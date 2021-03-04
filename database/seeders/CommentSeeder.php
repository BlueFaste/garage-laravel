<?php

namespace Database\Seeders;

use App\Models\Annoucement;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()
            ->count(10)
            ->for(Annoucement::all()->random())
            ->create();
    }
}
