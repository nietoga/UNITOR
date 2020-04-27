<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This is for testing goals.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create();
        DB::table('users')->insert([
            'name' => 'root',
            'email' => 'root@unitor.com',
            'password' => Hash::make('root'),
            'type' => User::ADMIN_TYPE,
        ]);
    }
}
