<?php

namespace App\Http\Livewire;

use App\Models\messages;
use App\Models\chat;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class FriendsChat extends Component
{
    use WithFileUploads;
    public $friend ,$messages,$chat_id,$masse,$user_id,$photo;

    public function getListeners()
    {
        return [
            "OpenChat"=> 'OpenChat',
            "echo-private:Sendmessages.{$this->chat_id},Message" => 'NewMessage',
        ];
    }
    public function mount()
    {

    }
    public function render()
    {

        // unset($this->masse);
        return view('livewire.friends-chat');
    }

    public function OpenChat($chat_id,$user_id){
        $this->chat_id=$chat_id;
        $this->user_id=$user_id;
        $this->friend=User::where('id',$user_id)->first();
        $this->messages=messages::where('chat_id',$chat_id)->get();
        $seens=messages::where('seen',false)->where('chat_id',$chat_id)->get();

        if(!empty($seens[0])){
            foreach($seens as $seen){
                if($seen->sent_by != Auth::user()->id){

                    $seen->seen=true;
                    $seen->save();
                }
            }
        }
        unset($this->masse);
    }


    public function savephoto()
    {
        $this->validate([
            'photo' => 'image|max:5120', // 5MB Max
        ]);
        $this->photo->store('photos');
        // $image = $request->file('file_name');
        // $file_name = $image->getClientOriginalName();

        // $attachments =  new invoice_attachments();
        // $attachments->file_name = $file_name;
        // $attachments->invoice_number = $request->invoice_number;
        // $attachments->invoice_id = $request->invoice_id;
        // $attachments->Created_by = Auth::user()->name;
        // $attachments->save();

        // // move pic
        // $imageName = $request->file_name->getClientOriginalName();
        // $request->file_name->move(public_path('Attachments/'. $request->invoice_number), $imageName);
        // $this->photo->store('photos');
    }

    public function GetNewMessages(){

        $this->messages=messages::where('chat_id',$this->chat_id)->get();
    }
    public function SendMessage(){


        if(isset($this->masse)){
        //event(new \App\Events\Message($this->masse,$this->chat_id,Auth::user()->id));

       //check if chat is exist or not?
if(chat::where('id', '=', $this->chat_id)->exists()){
    messages::create([
        'message' => $this->masse,
        'is_attach' => false,
        'sent_by'=>Auth::user()->id,
        'chat_id'=>$this->chat_id,
        'seen'=>false,

    ]);

}else{
    $users=[Auth::user()->id,$this->user_id];
    $chat= new chat();
    $chat->save();
    $chat->user()->attach($users);
    $this->chat_id=$chat->id;
    messages::create([
        'message' => $this->masse,
        'is_attach' => false,
        'sent_by'=>Auth::user()->id,
        'chat_id'=>$this->chat_id,
        'seen'=>false,

    ]);
}

unset($this->masse);
    }
    }


}
