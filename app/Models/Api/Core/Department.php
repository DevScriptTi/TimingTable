<?php

namespace App\Models\Api\Core;

use App\Models\Api\Main\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name'];

    public function years(): HasMany
    {
        return $this->hasMany(Year::class);
    }
}
