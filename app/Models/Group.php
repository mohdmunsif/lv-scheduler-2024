<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Group extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'slug', 'is_active', 'position'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }


    public function entities()
    {
        return $this->belongsToMany(Entity::class, 'entity_groups', 'group_id', 'entity_id')->withTimestamps();
    }

    public function dayoff()
    {
        return $this->hasMany(DayoffUser::class, 'user_id');
    }

    public function scheduledays()
    {
        return $this->hasMany(Schedule::class, 'user_id');
    }
}
