<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\ManpowerRequest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ManpowerRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();
        $users = User::all();

        // If departments or users are not available, skip seeding
        if ($departments->isEmpty() || $users->isEmpty()) {
            $this->command->info('No departments or users found to seed.');
            return;
        }

        // Create 10 manpower requests
        for ($i = 0; $i < 10; $i++) {
            ManpowerRequest::create([
                'department_id' => $departments->random()->id,
                'position' => 'Position ' . ($i + 1),
                'skills_required' => 'Skill ' . rand(1, 10) . ', Skill ' . rand(11, 20),
                'urgency' => ['Low', 'Medium', 'High'][rand(0, 2)],
                'status' => ['Pending', 'Approved', 'Rejected'][rand(0, 2)],
                'requested_by' => $users->random()->id,
                'approved_by' => $users->random()->id ?? null,  // Set to null for some records
            ]);
        }

        $this->command->info('Manpower requests seeded successfully!');
    }
}
