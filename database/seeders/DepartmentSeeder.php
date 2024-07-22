<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("departments")->delete();


        $data = array(
           array('name' => 'Human Resources'),
           array('name' => 'Finance'),
           array('name' => 'IT'),
           array('name' => 'Marketing'),
           array('name' => 'Sales'),
           array('name' => 'Customer Service'),
           array('name' => 'Research and Development'),
           array('name' => 'Legal'),
           array('name' => 'Operations'),
           array('name' => 'Administration'),
        );

        DB::table('departments')->insert($data);
    }
}
