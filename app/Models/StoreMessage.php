<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreMessage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users_from(){
        return $this->hasMany(User::class,'id', 'from_id');
    }

    public function users_to_whom(){
        return $this->hasMany(User::class,'id', 'to_whom_id');
    }
}
