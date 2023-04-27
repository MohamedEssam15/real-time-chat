<div class="col-md-8 col-xl-6 chat">
    <div class="card">
        @if (isset($friend))
            <div class="card-header msg_head">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <img src="{{ asset('personal_photo/D.jpg') }}" class="rounded-circle user_img">
                        @if ($friend->offline_at == null)
                            <span class="online_icon"></span>
                        @else
                            <span class="online_icon offline"></span>
                        @endif
                    </div>
                    <div class="user_info">
                        <span>{{ $friend->name }}</span>
                        <p>
                            @if ($friend->offline_at == null)
                                is online now
                            @else
                                last seen {{ $friend->offline_at->diffForHumans() }}
                            @endif
                        </p>
                    </div>

                </div>

                <span id="action_menu_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="fas fa-ellipsis-v"></i></span>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Block</a>
                    <a class="dropdown-item" href="#">Logout</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>

            <div class="card-body msg_card_body " wire:poll="GetNewMessages" id="messageBody">

                @foreach ($messages as $message)
                    @if ($message->is_attach == 0)
                        @if ($message->sent_by == Auth::user()->id)
                            {{-- YOu --}}
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    {{ $message->message }}
                                    <span class="msg_time_send">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{ asset('personal_photo/D.jpg') }}" class="rounded-circle user_img_msg">
                                </div>
                            </div>
                        @else
                            {{-- Not YOu --}}
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{ asset('personal_photo/D.jpg') }}" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer">
                                    {{ $message->message }}
                                    <span class="msg_time">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endif
                    @else
                    @endif
                @endforeach

            </div>


            <div class="card-footer">
                <div class="input-group">
                    <div class="input-group-append">
                        <form  id="upload_form"   wire:submit.prevent="savephoto">
                            <div class="input-group-text attach_btn"style="padding: .86rem .75rem" wire:model="photo" >
                                <label class="form-label text-white m-1" for="customFile1"><i class="fas fa-paperclip"></i></label>
                                <input type="file" class="form-control d-none" id="customFile1" />
                            </div>
                            {{-- <span class="input-group-text attach_btn" type="file" wire:model="photo"><i class="fas fa-paperclip"></i></span> --}}
                            @error('photo') <span class="error">{{ $message }}</span> @enderror

                            {{-- <button type="submit">Save Photo</button> --}}


                    </div>
                    @if (isset($photo))

                    <div  class="form-control type_msg" ><img src="{{ $photo }}"></div>
                    <div class="input-group-append">
                        <button class="input-group-text send_btn" type="submit" ><i class="fas fa-location-arrow" ></i></button>
                    </div>

                    @else
                    <input wire:model="masse" class="form-control type_msg" placeholder="Type your message..."value="" id="resetel">
                    <div class="input-group-append">
                        <span class="input-group-text send_btn" type="button" onclick="Reset()" wire:click="SendMessage"><i class="fas fa-location-arrow" ></i></span>
                    </div>
                    @endif
                </form>
                </div>
            </div>

    </div>
    @endif
</div>


