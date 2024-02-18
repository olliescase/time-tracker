<?php

namespace Database\Seeders;

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
        if (User::query()->exists()) {
            return; // only run once
        }
        User::factory()->superAdmin()->state(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@oscase.uk',
            ]
        )->create();

        User::factory()->withRole()->state(
            [
                'name' => 'Test User',
                'email' => 'testuser@oscase.uk'
            ]
        )->create();
    }
}
