<?php

namespace App\Models\Api\Users;

use App\Models\Api\Core\Baladiya;
use App\Models\Api\Main\Lessen;
use App\Models\Api\Main\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $fillable = [
        'username',
        'name',
        'last',
        'date_of_birth',
        'baladiyas_id'
    ];

    public function baladiya(): BelongsTo
    {
        return $this->belongsTo(Baladiya::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Lessen::class);
    }
}
