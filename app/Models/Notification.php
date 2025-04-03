<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['type', 'user_id', 'requisition_id', 'message'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function requisition() {
        return $this->belongsTo(Requisition::class);
    }
}
