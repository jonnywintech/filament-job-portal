<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("teams")->delete();


        $data = array(
           array('name' => 'One','slug' => 'one'),
           array('name' => 'Spatie','slug' => 'spatie-team'),
        );

        DB::table('teams')->insert($data);
    }
}
