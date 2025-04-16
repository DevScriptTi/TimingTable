<?php

namespace App\Models\Api\Users;

use App\Models\Api\Core\Baladiya;
use App\Models\Api\Main\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'username',
        'name',
        'last',
        'date_of_birth',
        'inscreption_number',
        'baladiyas_id',
        'group_id'
    ];

    public function baladiya(): BelongsTo
    {
        return $this->belongsTo(Baladiya::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
