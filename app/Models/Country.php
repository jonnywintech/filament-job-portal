<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function city(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function team(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
