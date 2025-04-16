<?php

namespace App\Models\Api\Main;

use App\Enums\DayEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    protected $fillable = ['name', 'time_table_id'];

    protected $casts = [
        'name' => DayEnum::class
    ];

    public function timeTable(): BelongsTo
    {
        return $this->belongsTo(TimeTable::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Lessen::class);
    }
}
