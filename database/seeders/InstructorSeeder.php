<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instructor::create([
            'name'=>'instructor' ,
            'email'=> 'instructor@gmail.com',
            'password'=>bcrypt('123456789')
        ]) ;
    }
}
