<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        if (User::where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                'id' => Str::uuid(),
                'nik' => null,
                'username' => 'admin',
                'nama' => 'Administrator',
                'telepon' => null,
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
                'status' => 'approved',
                'role_id' => $adminRole->id,
            ]);
        }
    }
}
