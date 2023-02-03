<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['namespace'=>'Elementary'], function(){
    Route::get('/', [\App\Http\Controllers\main\MainIndexController::class, '__invoke'])->name('auth.login');
});

Route::group(['namespace'=>'Authorized'], function(){
    Route::group(['namespace'=>'News'], function(){
        Route::get('/news', [\App\Http\Controllers\News\NewsIndexController::class, '__invoke'])->name('news');
    });
    Route::group(['namespace'=>'Profile'], function(){
        Route::get('/users/{user}', [\App\Http\Controllers\Users\ProfilesShowController::class, '__invoke'])->name('profile');
        Route::post('/users/{user}/post-create', [\App\Http\Controllers\Users\StoreUserPostController::class, '__invoke'])->name('post.create');
        Route::get('/posts/{post}', [\App\Http\Controllers\Users\DeleteUserPostController::class, 'show'])->name('post.show');
        Route::delete('/posts/{post}', [\App\Http\Controllers\Users\DeleteUserPostController::class, '__invoke'])->name('post.delete');
        Route::get('/users/{user}/groups', [\App\Http\Controllers\Users\UserGroupsController::class, 'show'])->name('user.groups');
    });
    Route::group(['namespace'=>'Friends'], function(){
        Route::get('/friends', [\App\Http\Controllers\Users\FriendsController::class, 'show'])->name('friends');
        Route::get('/user-friends/{user}', [\App\Http\Controllers\Users\FriendsController::class, 'user_friends'])->name('user.friends');
        Route::post('/users/{user}/{invited}', [\App\Http\Controllers\Users\FriendsController::class, 'add'])->name('friends.add');
        Route::post('/friends', [\App\Http\Controllers\Users\FriendsController::class, 'confirm'])->name('friends.confirm');
        Route::delete('/friends/{invite}', [\App\Http\Controllers\Users\FriendsController::class, 'cancel'])->name('confirm.cancel');
        Route::delete('/friends/delete-friend/{friend}', [\App\Http\Controllers\Users\FriendsController::class, 'delete'])->name('friends.delete');
    });
    Route::group(['namespace'=>'Groups'], function(){
        Route::get('/groups', [\App\Http\Controllers\Groups\GroupsController::class, 'main_page'])->name('groups.main_page');
        Route::delete('/groups/{group_id}/{member_id}', [\App\Http\Controllers\Groups\GroupsController::class, 'exit'])->name('groups.exit');
        Route::get('/groups/create', [\App\Http\Controllers\Groups\GroupsController::class, 'create'])->name('groups.create');
        Route::post('/groups/create', [\App\Http\Controllers\Groups\GroupsController::class, 'store'])->name('groups.store');
        Route::get('/groups/{group}', [\App\Http\Controllers\Groups\GroupsController::class, 'group_page'])->name('groups.page');
        Route::post('/groups/{group}/join/{member}', [\App\Http\Controllers\Groups\GroupsController::class, 'join'])->name('groups.join');
        Route::post('/groups/{group}', [\App\Http\Controllers\Groups\GroupsController::class, 'post'])->name('groups.post');
        Route::delete('/groups/{group}/posts/{post}', [\App\Http\Controllers\Groups\GroupsController::class, 'post_delete'])->name('groups.post_delete');
        Route::get('/groups/members/{group}', [\App\Http\Controllers\Groups\GroupsController::class, 'members'])->name('groups.members');
    });
    Route::group(['namespace'=>'Messages'], function(){
        Route::get('/messages', [\App\Http\Controllers\Message\MessagesController::class, 'index'])->name('messages');
        Route::get('/users/{user}/message/{user_from}',
            [\App\Http\Controllers\Message\MessagesController::class, 'user_page_send'])->name('messages.user_page');
        Route::get('/messages/{user}', [\App\Http\Controllers\Message\MessagesController::class, 'send'])->name('messages.send');
    });
    Route::group(['namespace'=>'Search'], function(){
        Route::get('/search/users', [\App\Http\Controllers\Search\SearchController::class, 'index_users'])->name('search.users');
        Route::post('/search/users', [\App\Http\Controllers\Search\SearchController::class, 'users_search'])->name('search.users.form');
        Route::get('/search/groups', [\App\Http\Controllers\Search\SearchController::class, 'index_groups'])->name('search.groups');
        Route::post('/search/groups', [\App\Http\Controllers\Search\SearchController::class, 'groups_search'])->name('search.groups.form');
    });
    Route::group(['namespace'=>'Images'], function(){
        Route::post('/users/image-upload', [\App\Http\Controllers\Image\ImageController::class, 'upload_users'])->name('images.users.upload');
        Route::post('/groups/image-upload/{group}', [\App\Http\Controllers\Image\ImageController::class, 'upload_groups'])->name('images.groups.upload');
    });
});




