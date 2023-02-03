<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListGroupsUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function groups(){
        return $this->hasMany(ListGroup::class,'id', 'group_id');
    }

    public function users(){
        return $this->hasMany(User::class,'id', 'member_id');
    }

    public function posts(){
        return $this->hasMany(GroupPost::class,'id', 'group_id');
    }
}
