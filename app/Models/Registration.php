<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected $casts = [
        'properties' => 'json'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
