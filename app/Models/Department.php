<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";

    protected $fillable = ["name","","","","","",""];

    protected $casts = ["id"=> "integer","name"=> "string"];

    public function users() {
        return $this->belongsToMany(User::class,"", "user_id");
    }
}
