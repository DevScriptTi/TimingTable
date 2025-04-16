<?php

namespace App\Models\Api\Users;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'username',
        'is_super'
    ];

    protected $casts = [
        'is_super' => 'boolean'
    ];
}
