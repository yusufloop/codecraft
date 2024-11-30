<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ManpowerRequest;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Run RoleSeeder first to ensure roles are created
         $this->call(RoleSeeder::class);

         // Create users with roles
         $this->createApplicants();
         $this->createAdmins();
 
         // Call other seeders
         $this->call([
             DepartmentSeeder::class,
             ManpowerRequestSeeder::class,
             ApplicationSeeder::class,
             ApplyjobsSeeder::class,
         ]);

         User::updateOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);
    }

    public function createApplicants()
    {
        User::factory(5)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', 'applicant')->first());
        });
    }

    // Create 3 admins
    public function createAdmins()
    {
        User::factory(3)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', 'admin')->first());
        });
    }
}
