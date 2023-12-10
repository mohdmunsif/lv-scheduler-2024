<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\Entity;

class EntityGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = Group::all();

        Entity::all()->each(function ($entity) use ($groups) {
            $entity->groups()->attach(
                $groups->random(1)->pluck('id')
            );
        });

        $thisEntity = Entity::find(2);

        $thisEntity->groups()->sync([1, 2, 3]);
    }
}
