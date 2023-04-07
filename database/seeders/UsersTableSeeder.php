<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Claudio Gomes',
            'email' => 'claudiogs16@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => date("Y-m-d H:i:s"),
        ])
    }
}
