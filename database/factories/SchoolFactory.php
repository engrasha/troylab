<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\School;

class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
     

    public function definition()
    {
        
        
        return [
            'name' => 'School name', 
            'status' => 1
        ];
    }

  
}
