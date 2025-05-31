<?php

namespace App\Models\Api\Core;

use App\Models\Api\Users\Student;
use App\Models\Api\Users\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Baladiya extends Model
{
    protected $fillable = ['name' , 'wilaya_id'];

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }
}
