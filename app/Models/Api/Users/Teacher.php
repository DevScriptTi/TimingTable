<?php

namespace App\Models\Api\Users;

use App\Models\Api\Core\Baladiya;
use App\Models\Api\Core\Key;
use App\Models\Api\Main\Lessen;
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
        'baladiya_id'
    ];

    public function baladiya(): BelongsTo
    {
        return $this->belongsTo(Baladiya::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lessen::class);
    }

    public function key()
    {
        return $this->morphOne(Key::class, 'keyable');
    }
}
