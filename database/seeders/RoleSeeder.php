<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if roles exist before creating
        Role::firstOrCreate(['name' => 'applicant']);
        Role::firstOrCreate(['name' => 'admin']);
    }
}
