<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
        ]);
        User::create([
                'nis' => '192010568',
                'nama' => 'Reihan Andika AM',
                'email' => 'reiandika10@gmail.com',
                'avatar' => 'upload/avatar/user.png',
                'role' => 'Admin',
                'password' => Hash::make('admin')
        ]);
        Kategori::create([
            'kategori' => 'Desain Grafis'
        ]);
    }
}
