<?php

namespace App\Models\Api\Core;

use App\Models\Api\Main\Lessen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    protected $fillable = ['name'];

    public function sessions(): HasMany
    {
        return $this->hasMany(Lessen::class);
    }
}
