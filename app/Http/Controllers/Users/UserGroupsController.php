<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ListGroup;
use App\Models\ListGroupsUser;
use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;

class UserGroupsController extends BaseController
{
    public function show(User $user){
        $groups = ListGroupsUser::where('member_id', $user->id)->get();
        $user_groups = $this->service->user_groups($groups);
        return view('groups.groups_user', compact('user', 'user_groups'));
    }
}
