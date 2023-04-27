<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendsList extends Component
{

     public $online_member,$chat_list,$chat_member,$all_user=[],$chats_user,$search='';




    public function mount()
    {

        $this->chat_list=chat::with('user')->whereHas('user', function ($query) {
            $query->where('id', '=', Auth::user()->id);
           })->get();
           foreach($this->chat_list as $ch){
            $uss= chat::with('user')->where('id', '=', $ch->id)->first();

            foreach($uss->user as $us){

             if($us->id!=Auth::user()->id){
                array_push($this->all_user,$us->id);
             }

            }

        }




    }
    public function render()
    {

        $this->chats_user=User::whereIn('id',$this->all_user)->get();
        $this->online_member=User::where('name', 'LIKE',"%".$this->search."%")->get();
        return view('livewire.friends-list');
    }

    public function chat($id)
    {
    $chats = chat::with('user')->whereHas('user', function ($query) {
        $query->where('id', '=', Auth::user()->id);
       })->get();

       $uer=null;
       foreach($chats as $chat){
        // $uer=$chat->where('id','=',$id)->first();
        foreach($chat->user as $users){
        if($users->id==$id){
            $uer=$chat;
        }

        }






        if( $uer==null){
            $this->emit('OpenChat', $uer,$id);
        }else{
            $this->emit('OpenChat', $uer->id,$id);
        }
    }

}
}
