<?php

namespace Database\Seeders;

use App\Models\profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'member',
        ];


        foreach ($roles as $item) {
            $user = User::factory()->has(profile::factory()->state(['nama' => $item . " perpus"]))->create(['email' => $item . '@gmail.com']);
            $user->assignRole($item);
        }
    }
}
