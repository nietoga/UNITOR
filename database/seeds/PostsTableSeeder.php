<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'How to change a commit?',
            'content' => 'I was working on a project but I want to change the description of a commit I made',
            'user_id' => 4,
            'created_at' => '2020-03-16 22:11:57',
        ]);
    }
}
