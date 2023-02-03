<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\ConfirmUserRequest;
use App\Http\Requests\User\PostStoreRequest;
use App\Models\Friend;
use App\Models\FriendList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendsController extends BaseController
{
    public function show(){
        $invitations = Friend::where('invited_id', Auth::user()->id)->get();
        $invitations = $this->service->users_invite($invitations);
        $friends = FriendList::where('invite_friend_id', Auth::user()->id)->orWhere('invited_friend_id', Auth::user()->id)->get();
        $friends = $this->service->users_friend($friends);
        return view('main.friends', compact('invitations', 'friends'));
    }

    public function user_friends(User $user){
        $username = $user->name;
        $friends = FriendList::where('invite_friend_id', $user->id)->orWhere('invited_friend_id', $user->id)->get();
        $friends = $this->service->sort_user_info($friends, $user);
        return view('main.user_friends', compact('friends', 'username'));
    }

    public function add($user, $invited){
        $this->service->add($user, $invited);
        return redirect(asset('/users/'.$invited));
    }

    public function confirm(ConfirmUserRequest $request){
        $data = $request->validated();
        FriendList::create($data);
        Friend::where('invited_id', $data['invited_friend_id'])->where('invite_id', $data['invite_friend_id'])->delete();
        return redirect(asset('/friends'));
    }

    public function cancel($invite_id){
        $invite = Friend::find($invite_id);
        $invite->delete();
        return redirect(asset('/friends'));
    }

    public function delete($friend_id){
        $friend = FriendList::find($friend_id);
        $friend->delete();
        return redirect(asset('/friends'));
    }


}
