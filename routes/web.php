<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\BarbecuesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
// use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\DiscordBotController;
use App\Http\Controllers\ChatMessagesController;

Route::get('/', [IndexController::class, 'show'])->name('index');

Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
});

Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/test/profile', [TestController::class, 'indexProfile'])->name('test.profile');


Route::post('/api/chat/{barbecueId}', [ChatMessagesController::class, 'store']);


Route::resource('profile', ProfileController::class);

Route::get('friends', [FriendsController::class, 'index'])->name('friends.index');

Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');

Route::get('/auth/google', [GoogleController::class, 'index']);
Route::get('/auth/google/callback', [GoogleController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class);
});
Route::get('/profile/{id}/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');


Route::get('/api/barbecue/{id}/messages', [MessagesController::class, 'apiIndex']);

Route::delete('/friends/{id}', [FriendsController::class, 'destroy'])->name('friends.destroy');

Route::post('/sendfriendrequest/{id}', [FriendsController::class, 'store'])->name('sendfriendrequest');

Route::get('/api/user', [UserController::class, 'apiShowLogged']);

Route::post('/updateuserphoto/{id}', [UserController::class, 'update'])->name('updateuserphoto');

Route::resource('barbecues', BarbecuesController::class);
Route::resource('/barbecues/{barbecueId}/images', ImagesController::class);
Route::resource('/barbecues/{barbecueId}/edit', BarbecuesController::class);
Route::get('/api/barbecues', [BarbecuesController::class, 'apiIndex']);



Route::post('/api/discordbot', [DiscordBotController::class, 'broadcast']);

Route::post('/updateuserdescription/{id}', [UserController::class, 'updateDescription'])->name('updateuserdescription');

Route::post('/sendinvitation/{id}', [BarbecuesController::class, 'sendInvitation'])->name('sendinvitation');
Route::delete('/destroyfriendship/{id}', [BarbecuesController::class, 'destroyFriendship'])->name('destroyfriendship');
Route::post('/sendbarbecuejoinrequest/{id}', [BarbecuesController::class, 'sendBarbecueJoinRequest'])->name('sendbarbecuejoinrequest');

Route::post('/acceptbarbecuejoinrequest/{barbecueId}/{userId}', [BarbecuesController::class, 'acceptBarbecueJoinRequest'])->name('acceptbarbecuejoinrequest');

Route::post('/toggleprivate', [UserController::class, 'togglePrivate'])->name('toggleprivate');

Route::post('/addproduct/{id}', [BarbecuesController::class, 'addProduct'])->name('addproduct');
Route::post('/minusproduct/{id}', [BarbecuesController::class, 'minusProduct'])->name('minusproduct');
Route::post('/assignproduct/{id}', [BarbecuesController::class, 'assignProduct'])->name('assignproduct');


Route::resource('notifications', NotificationsController::class);
Route::resource('comments', CommentsController::class);

require __DIR__ . '/auth.php';


