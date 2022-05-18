<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student1 = User::create([
            'name' => 'student 1',
            'surname' => 'child 1',
            'email' => 'std1@ues.com',
            'password' => Hash::make('password')
        ]);

        $student2 = User::create([
            'name' => 'student 2',
            'surname' => 'child 2',
            'email' => 'student2@ues.com',
            'password' => Hash::make('password')
        ]);

        $student1->assignRole(UserRole::Student->value);
        $student2->assignRole(UserRole::Student->value);
    }
}
