<?php

namespace App\Models\Api\Main;

use App\Models\Api\Core\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Year extends Model
{
    protected $fillable = ['year', 'department_id'];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
