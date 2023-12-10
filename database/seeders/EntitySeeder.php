<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('entities')->insert([
            'name' => 'Dr Consultant',
            'position' => '1',
            'slug' => 'consultant',
            'is_active' => '1'
        ]);
        DB::table('entities')->insert([
            'name' => 'Dr Specialist',
            'position' => '2',
            'slug' => 'specialist',
            'is_active' => '1'
        ]);
        DB::table('entities')->insert([
            'name' => 'Dr MO',
            'position' => '3',
            'slug' => 'mo',
            'is_active' => '1'
        ]);
        DB::table('entities')->insert([
            'name' => 'Dr HO',
            'position' => '4',
            'slug' => 'ho',
            'is_active' => '1'
        ]);
        DB::table('entities')->insert([
            'name' => 'Dr HO two',
            'position' => '5',
            'slug' => 'ho-2',
            'is_active' => '1'
        ]);
        DB::table('entities')->insert([
            'name' => 'Dr MO two',
            'position' => '6',
            'slug' => 'mo-2',
            'is_active' => '1'
        ]);
        DB::table('entities')->insert([
            'name' => 'Dr HO three',
            'position' => '7',
            'slug' => 'ho-3',
            'is_active' => '1'
        ]);
    }
}
