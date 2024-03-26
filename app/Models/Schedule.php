<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function team_a()
    {
        return $this->belongsTo(Team::class, 'team_a_id');
    }

    public function team_b()
    {
        return $this->belongsTo(Team::class, 'team_b_id');
    }

    public function win_team()
    {
        return $this->belongsTo(Team::class, 'win_team_id');
    }
}
