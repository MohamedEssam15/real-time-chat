<?php
use App\Models\chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('Sendmessages.{chat_id}', function ($user, $chat_id) {
    $chat=chat::where('id',$chat_id)->first();
    foreach($chat->user as $users){
        if ($users->id ==$user->id){
            return true;
        }
    }
    return false;

});
// Broadcast::channel('messages.{chat_id}', function ($user,$chat_id) {

//             return true;
//             // $chat=chat::where('id',$chat_id)->first();
//             // foreach($chat->user as $users){
//             //     if ($users->id ==Auth::user()->id){
//             //     }
//             // }
//             // return false;
// });
