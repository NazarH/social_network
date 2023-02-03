<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\BaseController;
use App\Models\GroupPost;
use App\Models\ListGroupsUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;

class NewsIndexController extends BaseController
{
    public function __invoke(){
        $groups_user_list = ListGroupsUser::where('member_id', Auth::user()->id)->get();
        $foreign_user_list = $this->service->user_groups($groups_user_list);
        $posts_sort = $this->service->groups_post($foreign_user_list);
        return view('news.news', compact('posts_sort'));
    }
}
