<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alexandre',
            'email' => 'alexandre@email.com',
            'password' => '123123',
        ]);
        $this->call(ClientSeeder::class);
    }
}
