<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::factory(10)->create();
        
         


        //
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'username' => Str::random(10),
        //     'school_id' => 1,
        //     'password' => Hash::make('password'),
        // ]);
    }
}
