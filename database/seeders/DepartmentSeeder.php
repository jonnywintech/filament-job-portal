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
           'name' => 'Human Resources',
           'name' => 'Finance',
           'name' => 'IT',
           'name' => 'Marketing',
           'name' => 'Sales',
           'name' => 'Customer Service',
           'name' => 'Research and Development',
           'name' => 'Legal',
           'name' => 'Operations',
           'name' => 'Administration'
        );

        DB::table('departments')->insert($data);
    }
}
