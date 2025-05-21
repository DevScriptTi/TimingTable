<?php

namespace App\Models\Api\Users;

use App\Models\Api\Core\Key;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'username',
        'name',
        'last',
        'is_super'
    ];

    protected $casts = [
        'is_super' => 'boolean'
    ];

    public function key(){
        return $this->morphOne(Key::class, 'keyable');
    }
}
