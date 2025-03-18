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
            'birthDate' => '1999-10-13',
            'role' => 'Super Admin',
            'password' => 'password'
        ]);
    }
}


//php artisan make:seeder UserSeeder

//php artisan db:seed --class=UserSeeder