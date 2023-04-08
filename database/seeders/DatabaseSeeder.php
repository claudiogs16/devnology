<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Claudio Gomes',
            'email' => 'gomes16@gmail.com',
            'contact' => '+0012565253',
            'address' => 'Palmarejo',
            'Place' => 'Praia',
            'Caixa Postal' => '7206',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Joana Rosa',
            'email' => 'rosa@hotmail.com',
            'contact' => '+002389565874',
            'address' => 'Fazenda',
            'Place' => 'Praia',
            'Caixa Postal' => '7201',
        ]);




    }
}
