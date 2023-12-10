<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntityGroupRequest;
use App\Http\Requests\UpdateEntityGroupRequest;
use App\Models\EntityGroup;
use App\Models\Entity;
use App\Models\Group;
// use App\Models\EntityGroup;

class EntityGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'entitygroups.index',
            [
                'entities' => Entity::all(),
                'grouplist' => Group::all(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntityGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EntityGroup $entityGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntityGroup $entityGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntityGroupRequest $request, EntityGroup $entityGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntityGroup $entityGroup)
    {
        //
    }
}
