<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\BaseController;
use App\Http\Requests\User\PostStoreRequest;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Support\Facades\Auth;

class StoreUserPostController extends BaseController
{
    public function __invoke(PostStoreRequest $request){
        $data = $request->validated();
        $this->service->create_post($data);
        return redirect(asset('/users/'.Auth::user()->id));
    }
}
