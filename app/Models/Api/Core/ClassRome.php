<?php

namespace App\Models\Api\Core;

use App\Models\Api\Main\Lessen;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ClassRome extends Model
{
    protected $fillable = ['number'];

    public function lessens()
    {
        return $this->hasMany(Lessen::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function isBusy($start, $end, $day)
    {
        $lessens = $this->lessens;
        // Convert string times to Carbon instances
        $startTime = Carbon::parse($start);
        $endTime = Carbon::parse($end);

        foreach ($lessens as $lessen) {
            $curent_day = $lessen->day;            
            if ($curent_day == null) {
                continue;
            }
            if ($day == $curent_day->name && !($startTime->greaterThanOrEqualTo(Carbon::parse($lessen->end_time)) || $endTime->lessThanOrEqualTo(Carbon::parse($lessen->start_time)))) {
                return true;
            }
        }
        return false;
    }
}
