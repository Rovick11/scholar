<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users') -> insert([
            'firstName' => 'Rovick',
            'lastName' => 'Macalindong',
            'sex' => 'Male',
            'email' => 'rovickdilagmacalindong@gmail.com',
            'contactNo' => '12345678',
            'barangay' => 'Lumbangan',
            'birthDate' => '1999-10-13',
            'role' => 'Super Admin',
            'password' => hash::make('password')
        ]);

        DB::table('users') -> insert([
            'firstName' => 'dummy1',
            'lastName' => 'dumm',
            'sex' => 'Male',
            'email' => 'rovickmacalindong11@gmail.com',
            'contactNo' => '12345678',
            'barangay' => 'Barangay 2',
            'birthDate' => '1999-10-13',
            'role' => 'Admin',
            'password' => hash::make('password')
        ]);

        DB::table('users') -> insert([
            'firstName' => 'dummy2',
            'lastName' => 'dumm',
            'sex' => 'Male',
            'email' => 'rovick@gmail.com',
            'contactNo' => '12345678',
            'barangay' => 'Barangay 3',
            'birthDate' => '1999-10-13',
            'role' => 'User',
            'password' => hash::make('password')
        ]);
    }
}


//php artisan make:seeder UserSeeder

//php artisan db:seed --class=UserSeeder