<?php

namespace App\Services\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\BaseController;
use App\Http\Requests\Group\GroupStoreRequest;
use App\Http\Requests\Group\JoinRequest;
use App\Http\Requests\Group\PostRequest;
use App\Models\GroupPost;
use App\Models\ListGroup;
use App\Models\ListGroupsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UserStoreImage;
use App\Models\GroupsStoreImage;
use Illuminate\Support\Facades\Storage;

use App\Models\StoreMessage;

use App\Models\Friend;
use App\Models\User;

use App\Models\UserPost;

class Service
{
    public function posts_date($posts){
        foreach ($posts as $post) {
            $datetime = explode(' ', $post->created_at);
            $post->date = str_replace('-', '.', $datetime[0]) ;
            $post->time = substr($datetime[1], 0,-3);
        }
        return $posts;
    }

    public function users_invite($invitations){
        $invite_users = [];
        foreach($invitations as $invite){
            $user = User::where('id', $invite->invite_id)->get();
            $invite_users[] = [$user[0]->id, $user[0]->name, $invite->id];
        }
        return $invite_users;
    }

    public function users_friend($friends){
        $friends_list = [];
        foreach($friends as $friend){
            $user_id = $friend->invited_friend_id !== Auth::user()->id ? $friend->invited_friend_id : $friend->invite_friend_id;
            $user = User::where('id', $user_id)->get();
            $friends_list[] = [$user[0]->id, $user[0]->name, $friend->id];
        }
        return $friends_list;
    }

    public function sort_user_info($friends, $user){
        $friends_list = [];
        foreach($friends as $friend){
            $user_id = $friend->invited_friend_id !== $user->id ? $friend->invited_friend_id : $friend->invite_friend_id;
            $user = User::where('id', $user_id)->get();
            $friends_list[] = [$user[0]->id, $user[0]->name];
        }
        return $friends_list;
    }

    public function invite_sorts($invites, $user_id){
        foreach($invites as $k => $v){
            if($v->invite_id !== $user_id && $v->invited_id !== $user_id){
                unset($invites[$k]);
            }
        }

        return $invites;
    }

    public function friend_sorts($friend, $user_id){
        foreach($friend as $k => $v){
            if($v->invite_friend_id !== $user_id && $v->invited_friend_id !== $user_id){
                unset($friend[$k]);
            }
        }
        return $friend;
    }

    public function user($user_list){
        $user_ = [];
        foreach ($user_list as $user){
            if($user->member_id === Auth::user()->id){
                $user_[] = $user;
            }
        }
        return $user_;
    }

    public function ather_groups($ather){
        $ather_list = [];
        foreach($ather as $group){
            $ather_list[] = $group->groups;
        }
        return $ather_list;
    }

    public function user_list($user_list){
        $users = [];
        foreach ($user_list as $user){
            $users[] = $user->users;
        }
        foreach ($users as $user){
            foreach ($user_list as $value){
                if($user[0]->id === $value->member_id){
                    $user[0]['role'] = $value->role;
                }
            }
        }
        return $users;
    }

    public function groups_post_time($posts){
        foreach ($posts as $post) {
            $datetime = explode(' ', $post->created_at);
            $post->date = $datetime[0];
            $post->time = $datetime[1];
        }
        return $posts;
    }

    public function user_groups($groups){
        $user_groups = [];
        foreach ($groups as $group){
            $user_groups[] = $group->groups;
        }
        return $user_groups;
    }

    public function groups_post($foreign_user_list){
        $posts_sort = [];
        $all_posts = GroupPost::all();
        foreach ($all_posts as $post){
            foreach ($foreign_user_list as $group){
                if($post->group_id === $group[0]->id){
                    $post->group_name = $group[0]->name;
                    $datetime = explode(' ', $post->created_at);
                    $post->date = $datetime[0];
                    $post->time = $datetime[1];
                    $posts_sort[] = $post;
                }
            }
        }
        return $posts_sort;
    }

    public function users_list($messages){
        $users = [];
        $names = [];
        foreach ($messages as $message){
            $user = $message->users_from;
            $user2 = $message->users_to_whom;
            if(!empty($users)){
                $key = array_search($user[0]->name, $names);
                $key2 = array_search($user2[0]->name, $names);
                if($key !== false || $key2 !== false) continue;
            }
            if($user[0]->id === Auth::user()->id){
                $user2[0]->to_whom = $user2[0]->name;
                $users[] = $user2[0];
                $names[] = $user2[0]->name;
            }else if($user2[0]->id === Auth::user()->id){
                $user[0]->from = $user[0]->name;
                $users[] = $user[0];
                $names[] = $user[0]->name;
            }
        }
        return $users;
    }

    public function user_messages($users_list){
        $messages_sort = [];
        foreach ($users_list as $user){
            $messages_list = [];
            $messages = StoreMessage::where('from_id', $user->id)->orWhere('to_whom_id', $user->id)->get();
            foreach ($messages as $message){
                if($message->from_id !== Auth::user()->id && $message->to_whom_id !== Auth::user()->id) continue;
                if($user->from === Auth::user()->name){
                    $message->name = "You";
                } else {
                    $from = $message->users_from;
                    $message->name = $from[0]->name;
                }
                $messages_list[] = $message;
            }
            $messages_sort[] = $messages_list;
        }
        return $messages_sort;
    }

    /* groups */

    public function store($data){
        ListGroup::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'type' => $data['type'],
            'creator_id' => Auth::user()->id
        ]);
        $group_info = ListGroup::where('name', $data['name'])->get();
        ListGroupsUser::create([
            'member_id' => $group_info[0]->creator_id,
            'group_id' => $group_info[0]->id,
            'role' => 'admin'
        ]);
    }

    public function join($group, $member){
        ListGroupsUser::create([
            'group_id' => $group,
            'member_id' => $member
        ]);
    }

    /* image */

    public function upload_users($request){
        $path = $request->file('img')->store('users', 'public');
        $photo = UserStoreImage::where('user_id', Auth::user()->id)->get();
        if(empty($photo[0])){
            UserStoreImage::create([
                'user_id' => Auth::user()->id,
                'img_url' => $path
            ]);
        } else {
            Storage::disk('public')->delete($photo[0]->img_url);
            $photo[0]->update(['img_url' => $path]);
        }
    }

    public function upload_groups($request, $group_id){
        $path = $request->file('img')->store('groups', 'public');
        $photo = GroupsStoreImage::where('group_id', $group_id)->get();
        if(empty($photo[0])){
            GroupsStoreImage::create([
                'group_id' => $group_id,
                'img_url' => $path
            ]);
        } else {
            Storage::disk('public')->delete($photo[0]->img_url);
            $photo[0]->update(['img_url' => $path]);
        }
    }

    /* message */

    public function user_page_send($user, $user_from, $data){
        StoreMessage::create([
            'message' => $data['message'],
            'from_id' => $user_from,
            'to_whom_id' => $user
        ]);
    }

    public function send($data){
        StoreMessage::create([
            'message' => $data['message'],
            'from_id' => Auth::user()->id,
            'to_whom_id' => $data['to_whom_id']
        ]);
    }

    /* friends */

    public function add($user, $invited){
        Friend::create([
            'invite_id' => $user,
            'invited_id' => $invited
        ]);
    }

    /* Post */

    public function create_post($data){
        UserPost::create([
            'post' => $data['post'],
            'user_id' => Auth::user()->id
        ]);
    }
}
