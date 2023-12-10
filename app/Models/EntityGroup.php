<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityGroup extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'entity_id', 'group_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    // public function scopeActive(Builder $query): Builder
    // {
    //     return $query->where('is_active', true);
    // }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'entity_groups', 'entity_id', 'group_id')->withTimestamps();
    }

    public function entities()
    {
        return $this->belongsToMany(Entities::class, 'entity_groups', 'group_id', 'entity_id')->withTimestamps();
    }
}
