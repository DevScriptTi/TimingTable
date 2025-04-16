<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TimeTable extends Model
{
    public function timeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
    }
}
