
        @extends('layouts.app')
        @section('title','Chats')
        @section('styles')
        <link rel="stylesheet" type="text/css" href="{{asset("css/chat.css");}}">
        @livewireStyles
        @endsection
        @section('content')
        <nav class="navbar navbar-expand-lg " style="background-color: #0000004d;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <h1 class="navbar-brand"style="color: #b4b2b2 ;" href="#">Friends Chat</h1>
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

              </ul>
              <div class="dropdown">
                <div style="margin-right: 10px;" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{-- if there is notify color this --}}
                <i class="far fa-bell fa-2x" style="color: #b4b2b2 ;" ></i>
                <span class="have_notify"></span>

                </div>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                    <a class="dropdown-item" href="#">Settings</a>
                  <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" style="background-color: #00000050;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name}}
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings</a>
                  <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>


            </div>
        </nav>
		<div class="container-fluid h-100">
            <div class="row justify-content-center h-100">
            @livewire('friends-list')


			@livewire('friends-chat')
            </div>
		</div>

        @endsection
@section('scripts')
@livewireScripts
<script src="{{ mix('js/app.js') }}" ></script>
<script>
    function GFG_Fun(ss) {

        const sus = document.getElementsByTagName("li");
        for (let i = 0; i < sus.length; i++) {
            sus.item(i).classList.remove('active');
        }
        document.getElementById(ss).classList.add('active');

    }
    function Reset() {

document.getElementById("resetel").value = "";

}

  document.getElementById("upload_form").onchange = function() {
      // submitting the form
      document.getElementById("upload_form").submit();
  };


</script>
@endsection

