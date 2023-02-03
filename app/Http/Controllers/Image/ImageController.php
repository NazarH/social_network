<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\BaseController;
use App\Models\GroupsStoreImage;
use App\Models\ListGroup;
use App\Models\User;
use App\Models\UserStoreImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends BaseController
{
    public function upload_users(Request $request){
        if(empty($request->file('img'))) return redirect(asset('/users/'.Auth::user()->id));
        $this->service->upload_users($request);
        return redirect(asset('/users/'.Auth::user()->id));
    }

    public function upload_groups($group_id, Request $request){
        if(empty($request->file('img'))) return redirect(asset('/groups/'.$group_id));
        $this->service->upload_groups($request, $group_id);
        return redirect(asset('/groups/'.$group_id));
    }
}
