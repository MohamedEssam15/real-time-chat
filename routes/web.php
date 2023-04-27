<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
define("controller_root","App\Http\Controllers\\");
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('signin');
})->middleware('guest');
Route::get('/signin', function(){
    return view("auth.login");
})->middleware('guest');
Route::get('/login', function(){
    return view("auth.login");
})->name("login")->middleware('guest');
Route::get('/signup', function(){
  return view("auth.signup");
})->middleware('guest');
Route::post("/signup",controller_root.'AuthController@signup')->name("signup");
Route::post("/signin",controller_root.'AuthController@signin')->name("signin");

Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
})->middleware('guest');

Route::get('/logout', function(){
    $use= User::where('id',Auth::user()->id)->first();
    $use->offline_at=now();
    $use->save();
    Auth::logout();
    return redirect()->route('signin');
 })->name('logout')->middleware('auth');

Route::get('/chat',function(){
 return view('ChatPages.Chat');
})->middleware('auth');


