<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'properties' => 'json'
    ];

    public function getFullnameAttribute()
    {
        return "{$this->prefix}{$this->first_name} {$this->last_name}";
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'registration_sports');
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'registration_positions');
    }
}
