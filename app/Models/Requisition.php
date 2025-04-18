<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $table = "requisitions";
    protected $fillable = [
        'destination',
        'client',
        'reason',
        'travel_mode',
        'trip_date',
        'user_id',
        'department_id',
    ];

    protected $casts = [
        'trip_date' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

}
