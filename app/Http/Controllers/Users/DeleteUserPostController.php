<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserPost;

class DeleteUserPostController extends Controller
{
    public function show(UserPost $post){
        return view('main.user_post', compact('post'));
    }
    public function __invoke(UserPost $post){
        $post->delete();
        return redirect()->route('news');
    }
}
