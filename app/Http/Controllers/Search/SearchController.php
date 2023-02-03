<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use App\Models\ListGroup;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index_users(){
        $users = User::all();
        return view('search.search_users', compact('users'));
    }

    public function users_search(SearchRequest $request){
        $data = $request->validated();
        $users = User::where('name', $data['name'])->get();
        return view('search.search_users', compact('users'));
    }

    public function index_groups(){
        $groups = ListGroup::all();
        return view('search.search_groups', compact('groups'));
    }

    public function groups_search(SearchRequest $request){
        $data = $request->validated();
        $groups = ListGroup::where('name', $data['name'])->get();
        return view('search.search_groups', compact('groups'));
    }
}
