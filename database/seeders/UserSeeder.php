<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'email' => 'rovickdilagmacalindong@gmail.com',
            'contactNo' => '12345678',
            'birthDate' => '1999-10-13',
            'role' => 'Super Admin',
            'password' => 'password'
        ]);

        DB::table('users') -> insert([
            'firstName' => 'dummy1',
            'lastName' => 'dumm',
            'email' => 'rovickmacalindong11@gmail.com',
            'contactNo' => '12345678',
            'birthDate' => '1999-10-13',
            'role' => 'Admin',
            'password' => 'password'
        ]);

        DB::table('users') -> insert([
            'firstName' => 'dummy2',
            'lastName' => 'dumm',
            'email' => 'rovick@gmail.com',
            'contactNo' => '12345678',
            'birthDate' => '1999-10-13',
            'role' => 'User',
            'password' => 'password'
        ]);
    }
}


//php artisan make:seeder UserSeeder

//php artisan db:seed --class=UserSeeder