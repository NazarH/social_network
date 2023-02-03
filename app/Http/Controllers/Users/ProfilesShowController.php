<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\FriendList;
use App\Models\User;
use App\Models\UserPost;
use App\Models\UserStoreImage;
use Illuminate\Support\Facades\Auth;

class ProfilesShowController extends BaseController
{
    public function __invoke(User $user){
        $user_id = $user->id;
        $image = UserStoreImage::where('user_id', $user_id)->get();
        $posts = UserPost::where('user_id', $user_id)->get();
        $invite = Friend::where('invited_id', Auth::user()->id)
            ->orWhere('invite_id', Auth::user()->id)
            ->get();
        $friend = FriendList::where('invited_friend_id', Auth::user()->id)
            ->orWhere('invite_friend_id', Auth::user()->id)
            ->get();
        $this->service->invite_sorts($invite, $user_id);
        $this->service->friend_sorts($friend, $user_id);
        $this->service->posts_date($posts);
        return view('main.user_page', compact('user', 'posts', 'invite', 'friend', 'image'));
    }

    public function send_message(){

    }
}
