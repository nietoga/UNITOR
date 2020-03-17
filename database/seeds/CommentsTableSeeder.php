<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'description' => 'Did you do aditional changes?',
            'post_id' => 1,
            'user_id' => 4,
            'created_at' => '2020-03-16 22:11:57',
            'updated_at' => '2020-03-17 16:10:02',

        ]);
        DB::table('comments')->insert([
            'description' => 'Maybe it is better to delete that commit',
            'post_id' => 1,
            'user_id' => 2,
            'created_at' => '2020-03-16 22:11:57',
            'updated_at' => '2020-03-17 16:10:02',
        ]);
        DB::table('comments')->insert([
            'description' => 'You can use git rebase. For example, if you want to modify commit bbc643cd, run: $ git rebase --interactive <commit-name>',
            'post_id' => 1,
            'user_id' => 1,
            'created_at' => '2020-03-16 22:11:57',
            'updated_at' => '2020-03-17 16:10:02',
            'fixed' => true,
        ]);
    }
}
