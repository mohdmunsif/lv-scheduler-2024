<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'user_id', 'team_id', 'slug', 'is_active', 'position'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'users', 'entity_id', 'user_id')->withTimestamps();
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'entity_groups', 'entity_id', 'group_id')->withTimestamps();
    }

    public function dayoff()
    {
        return $this->hasMany(DayoffUser::class, 'entity_id');
    }

    public function scheduledays()
    {
        return $this->hasMany(Schedule::class, 'entity_id');
    }
}
