
    <div class="col-md-4 col-xl-3 chat">
        <div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header">
                <div id="action_list_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="fas fa-ellipsis-v"></i></div>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Block</a>
                    <a class="dropdown-item" href="#">Logout</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Search..." name="" class="form-control search"
                        wire:model="search">
                    <div class="input-group-prepend">
                        <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                    </div>

                </div>
            </div>
            <div class="card-body contacts_body">
                <ul class="contacts">
                    @if (!empty($search))
                        <div class="user_info">
                            <span>members</span>
                        </div>
                        @if (isset($online_member[0]))



                            @foreach ($online_member as $user)
                                @if ($user->id == Auth::user()->id)
                                    @continue
                                @endif

                                <li id="{{ 'test' . $user->id }}" type="button"
                                    onclick="GFG_Fun('{{ 'test' . $user->id }}')"  wire:click="chat({{ $user->id }})">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{ asset('personal_photo/D.jpg') }}"
                                                class="rounded-circle user_img">
                                                @if ($user->offline_at==null)
                                                <span class="online_icon"></span>
                                                @else
                                                <span class="online_icon offline"></span>
                                            @endif

                                        </div>
                                        <div class="user_info">
                                            <span>{{ $user->name }}</span>
                                            <p>@if ($user->offline_at==null)
                                                is online now
                                                @else
                                                last seen {{$user->offline_at->diffForHumans()}}
                                            @endif</p>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <div class="text_inline"><span>No member found </span><i class="far fa-frown"></i>
                            </div>

                        @endif
                    @else

                    <li>
                        <div class="d-flex bd-highlight">
                            <div class="user_info">
                                <span>Chats</span>
                            </div>
                        </div>
                    </li>



                    @foreach ($chats_user as $user)
                        <li id="{{ 'test' . $user->id }}" type="button" onclick="GFG_Fun('{{ 'test' . $user->id }}')"
                            wire:click="chat({{ $user->id }})">
                            <div class="d-flex bd-highlight" wire:poll.60s>
                                <div class="img_cont">
                                    <img src="{{ asset('personal_photo/D.jpg') }}" class="rounded-circle user_img">
                                    @if ($user->offline_at==null)
                                                <span class="online_icon"></span>
                                                @else
                                                <span class="online_icon offline"></span>
                                            @endif
                                </div>
                                <div class="user_info">

                                    <span>
                                        {{ $user->name }}
                                    </span>
                                    <p>@if ($user->offline_at==null)
                                        is online now
                                        @else
                                        last seen {{$user->offline_at->diffForHumans()}}
                                    @endif</p>


                                </div>
                            </div>
                        </li>
                    @endforeach

                    @endif

                </ul>

            </div>
            <div class="card-footer"></div>
        </div>
    </div>


