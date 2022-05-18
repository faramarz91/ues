<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'teacher',
            'surname' => 'life',
            'email' => 'teacher@ues.com',
            'password' => Hash::make('password')
        ]);

        $user->assignRole(UserRole::Teacher->value);
    }
}
