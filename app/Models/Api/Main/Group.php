<?php

namespace App\Models\Api\Main;

use App\Models\Api\Users\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Group extends Model
{
    protected $fillable = ['number', 'section_id'];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function timeTable(): MorphOne
    {
        return $this->morphOne(TimeTable::class, 'timeable');
    }
}
