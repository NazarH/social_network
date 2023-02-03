<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\BaseController;
use App\Http\Requests\Group\GroupStoreRequest;
use App\Http\Requests\Group\JoinRequest;
use App\Http\Requests\Group\PostRequest;
use App\Models\GroupPost;
use App\Models\GroupsStoreImage;
use App\Models\ListGroup;
use App\Models\ListGroupsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupsController extends BaseController
{
    public function main_page(){
        $personal = ListGroup::where('creator_id', Auth::user()->id)->get();
        $ather = ListGroupsUser::where('member_id', Auth::user()->id)->get();
        $ather_list = $this->service->ather_groups($ather);
        return view('groups.groups', compact('personal', 'ather_list'));
    }

    public function create(){
        return view('groups.group_create');
    }

    public function store(GroupStoreRequest $request){
        $data = $request->validated();
        $this->service->store($data);
        return redirect(asset('/groups'));
    }

    public function group_page(ListGroup $group){
        $image = GroupsStoreImage::where('group_id', $group->id)->get();
        $user_list = ListGroupsUser::where('group_id', $group->id)->get();
        $user = $this->service->user($user_list);
        $posts = GroupPost::where('group_id', $group->id)->get();
        $this->service->posts_date($posts);
        return view('groups.group_page', compact('group', 'user_list', 'user', 'posts', 'image'));
    }

    public function join($group, $member){
        $this->service->join($group, $member);
        return redirect(asset('/groups/'.$group));
    }

    public function members(ListGroup $group){
        $user_list = ListGroupsUser::where('group_id', $group->id)->get();
        $user_list_f = $this->service->user_list($user_list);
        return view('groups.group_members', compact('user_list_f'));
    }

    public function exit($group_id, $member_id){
        $member = ListGroupsUser::where('member_id', $member_id)->where('group_id', $group_id)->get();
        $member[0]->delete();
        return redirect(asset('/groups/'.$group_id));
    }

    public function post(PostRequest $request, ListGroup $group){
        $data = $request->validated();
        $data['group_id'] = $group->id;
        GroupPost::create($data);
        return redirect(asset('/groups/'.$group->id));
    }

    public function post_delete($group, $post){
        $del_post = GroupPost::where('id', $post)->get();
        $del_post[0]->delete();
        return redirect(asset('/groups/'.$group));
    }
}
