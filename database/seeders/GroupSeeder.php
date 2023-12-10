<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            'name' => 'Consultant',
            'descr' => 'First',
            'position' => '1',
            'slug' => 'consultant',
            'is_active' => '1'
        ]);
        DB::table('groups')->insert([
            'name' => 'Specialist',
            'descr' => 'Second',
            'position' => '2',
            'slug' => 'specialist',
            'is_active' => '1'
        ]);
        DB::table('groups')->insert([
            'name' => 'MO',
            'descr' => 'Third',
            'position' => '3',
            'slug' => 'mo',
            'is_active' => '1'
        ]);
        DB::table('groups')->insert([
            'name' => 'HO',
            'descr' => 'Fourth',
            'position' => '4',
            'slug' => 'ho',
            'is_active' => '1'
        ]);
        DB::table('groups')->insert([
            'name' => 'HO 2',
            'descr' => 'Fifth',
            'position' => '5',
            'slug' => 'ho2',
            'is_active' => '1'
        ]);
        DB::table('groups')->insert([
            'name' => 'MO 2',
            'descr' => 'Sixth',
            'position' => '6',
            'slug' => 'mo2',
            'is_active' => '1'
        ]);
    }
}
