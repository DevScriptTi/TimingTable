<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Section extends Model
{
    protected $fillable = ['number', 'year_id'];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function timeTable(): MorphOne
    {
        return $this->morphOne(TimeTable::class, 'timeable');
    }
}
