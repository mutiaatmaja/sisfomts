<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\PendidikTendik;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $guruRole = Role::create(['name' => 'guru']);
        $siswaRole = Role::create(['name' => 'siswa']);

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->addRole($adminRole);

        // Create sample guru (teacher)
        $guruUser = User::create([
            'name' => 'Guru Sample',
            'email' => 'guru@example.com',
            'password' => bcrypt('password'),
        ]);
        $guruUser->addRole($guruRole);

        // Create guru profile
        PendidikTendik::create([
            'uuid' => fake()->uuid(),
            'nuptk' => '1234567890',
            'nip' => '198501012015011001',
            'user_id' => $guruUser->id,
        ]);

        // Create sample siswa (student)
        $siswaUser = User::create([
            'name' => 'Siswa Sample',
            'email' => 'siswa@example.com',
            'password' => bcrypt('password'),
        ]);
        $siswaUser->addRole($siswaRole);
    }
}
