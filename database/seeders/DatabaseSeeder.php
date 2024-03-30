<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Team;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::query()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('adminadmin'),
        ]);

        University::query()->insert([
            [
                'id' => Str::uuid(),
                'name' => 'ม.ราชภัฏสุราษฎร์ธานี',
                'domain' => 'sru.ac.th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ม.ราชภัฏนครศรีธรรมราช',
                'domain' => 'nstru.ac.th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ม.ราชภัฏภูเก็ต',
                'domain' => 'pkru.ac.th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ม.ราชภัฏสงขลา',
                'created_at' => now(),
                'domain' => 'skru.ac.th',
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ม.ราชภัฏยะลา',
                'domain' => 'yru.ac.th',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
