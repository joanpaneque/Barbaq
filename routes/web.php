<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\BarbecuesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\DiscordBotController;

Route::get('/', [IndexController::class, 'show'])->name('index');

Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
});

Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/test/profile', [TestController::class, 'indexProfile'])->name('test.profile');

Route::resource('profile', ProfileController::class);

Route::get('friends', [FriendsController::class, 'index'])->name('friends.index');

Route::get('/participation', [ParticipationController::class, 'index'])->name('participation.index');

Route::get('/auth/google', [GoogleController::class, 'index']);
Route::get('/auth/google/callback', [GoogleController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class);
});

Route::get("/api/my-barbecues", [BarbecuesController::class, 'apiMyBarbecues']);

Route::delete('/friends/{id}', [FriendsController::class, 'destroy'])->name('friends.destroy');

Route::post('/sendfriendrequest/{id}', [FriendsController::class, 'store'])->name('sendfriendrequest');

Route::get('/api/user', [UserController::class, 'apiShowLogged']);

Route::post('/updateuserphoto/{id}', [UserController::class, 'update'])->name('updateuserphoto');

Route::resource('barbecues', BarbecuesController::class);
Route::resource('/barbecues/{barbecueId}/images', ImagesController::class);
Route::get('/api/barbecues', [BarbecuesController::class, 'apiIndex']);


Route::post('/api/discordbot', [DiscordBotController::class, 'broadcast']);

Route::post('/sendinvitation/{id}', [BarbecuesController::class, 'sendInvitation'])->name('sendinvitation');
Route::delete('/destroyfriendship/{id}', [BarbecuesController::class, 'destroyFriendship'])->name('destroyfriendship');
Route::post('/sendbarbecuejoinrequest/{id}', [BarbecuesController::class, 'sendBarbecueJoinRequest'])->name('sendbarbecuejoinrequest');

Route::post('/acceptbarbecuejoinrequest/{barbecueId}/{userId}', [BarbecuesController::class, 'acceptBarbecueJoinRequest'])->name('acceptbarbecuejoinrequest');

Route::post('/toggleprivate', [UserController::class, 'togglePrivate'])->name('toggleprivate');

Route::post('/addproduct/{id}', [BarbecuesController::class, 'addProduct'])->name('addproduct');
Route::post('/assignproduct/{id}', [BarbecuesController::class, 'assignProduct'])->name('assignproduct');


Route::resource('notifications', NotificationsController::class);
Route::resource('comments', CommentsController::class);

require __DIR__ . '/auth.php';


