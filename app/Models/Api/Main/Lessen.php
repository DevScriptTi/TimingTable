<?php

namespace App\Models\Api\Main;

use App\Enums\SessionTypeEnum;
use App\Models\Api\Core\ClassRome;
use App\Models\Api\Core\Module;
use App\Models\Api\Users\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lessen extends Model
{
    protected $fillable = [
        'start_time',
        'end_time',
        'type',
        'day_id',
        'module_id',
        'teacher_id',
        'class_rome_id'
    ];

    protected $casts = [
        'type' => 'string',
    ];

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classRome(): BelongsTo
    {
        return $this->belongsTo(ClassRome::class);
    }
}
