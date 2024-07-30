@extends('home')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('extra-css')
<style>
.greenDot::after{
    content:'';
    position: absolute;
    top: 20px;
    right: 10px;
    padding: 1px;
    background-color: rgb(46, 172, 109);
    width: 8px;
    height: 8px;
    border-radius: 50%;
}
.redDot::after{
    content:'';
    position: absolute;
    top: 20px;
    right: 10px;
    padding: 1px;
    background-color: rgb(165, 0, 0);
    width: 8px;
    height: 8px;
    border-radius: 50%;
}
.messageThread{
    height: 400px;
    overflow-y: auto;
}
.senderBox{
    background-color: rgb(228, 228, 228, 0.5);
    border-radius: 7px;
    box-shadow: 0 0 3px gray;
    max-width:70%;
}
.recieverBox{
    color: white;
    background-color: rgb(13, 126, 160);
    border-radius: 7px;
    box-shadow: 0 0 3px gray;
    max-width:70%;
    margin-left: auto;
}
.messageInput{
    resize: none;
    width:100%;
}
#sendMsgBtn{
    position: absolute;
    bottom:0;
    right:0;
}
</style>
@endsection

@section('index')
<div class="content">
    <div class="row">
    <div class="container">
    <div class="row justify-content-center">

        <!-- LIST OF ONLINE USERS -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"> {{ trans('multi-leng.formerror281')}}</div>

                <div class="card-body">
                    <div class="list-group">
                        @foreach($arreglo as $row => $slice)
                        <a href="javascript:;" onclick="openChatBox('{{$arreglo[$row]['name']}}', '{{Crypt::encrypt($arreglo[$row]['id']) }}', '{{Crypt::encrypt(Auth::user()->id) }}' );" class="list-group-item list-group-action-item"> 
                            <div class="d-flex" style="border:0px solid red">
                                <span id="{{$arreglo[$row]['id']}}'">
                                    
                                    {{$arreglo[$row]['name']}}
                                    <br>
                                    <small class="text-primary">({{$arreglo[$row]['cargo']}})</small>
                                </span>
                                <span class="ml-auto text-muted @if($arreglo[$row]['usuario_status'] == 0) redDot text-warning @else greenDot  text-success @endif">
                                    @if($arreglo[$row]['usuario_status'] == 0) 
                                        Offline 
                                    @else 
                                        Online 
                                    @endif
                                    
                            </div>
                        </a>
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8" id="default_card">
            <div class="card">
                <div class="card-header"> {{ trans('multi-leng.formerror282')}}</div>
                <div class="card-body">
                    <h1 class="text-primary"> {{ __('userreg.userreg162') }}</h1>
                </div>
            </div>
        </div>

        <!-- CHAT BOX OF THE SELECTED USER -->
        <div class="col-md-8" id="active_card" style="display:none;">
            <div class="card">
                <div class="card-header" id="chatWithName">(Name of Selected User)</div>

                <div class="card-body messageThread" id="messageThread">
                    <h1 id="loadingMessages">{{ __('userreg.userreg163') }}</h1>
                    <!-- <div class="p-2 d-flex">     
                        <div class="float-left p-2 mb-2 senderBox">
                            <p> Sender message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever</p>
                        </div>
                    </div>

                    <div class="p-2 d-flex">
                        <div class="p-2 recieverBox ml-auto">
                            <p> This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever </p>
                        </div>
                    </div> -->

                </div>

                <div class="card-body p-0 m-0" style="border:0px solid black">
                    
                    <form method="POST" onsubmit="submitMessage();">
                        @csrf
                        <div class="mt-3 col-12">
                            <input type="hidden" id="convo_id" name="convo_id" required>
                            <textarea class="form-control" style="display:block;padding-left:10px;padding-right:10px;" name="message" id="messsageInput" rows="3" required></textarea>
                        </div>
                        <div class="mt-3 col-12">
                            &nbsp;
                        </div>
                        <div class="col-12">
                            <br>
                            <button type="submit" class="btn btn-primary mr-3 mt-5" id="sendMsgBtn">{{ __('userreg.userreg165') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>


    </div>
</div> 
    </diV>
</div>
@endsection

@section('extra-script')

<script type="text/javascript">
    var lastMessageId = 0;
    // auto scroll down chatbox when sending a message
    function scrollPaubos(){
        var a = document.getElementById('messageThread');
        a.scrollTop = a.scrollHeight;
    }
    // when choosing a user to message
    function openChatBox(name, id, authUser)
    {
        $('#messageThread').html('<h1 class="text-center"> {{ __('userreg.userreg163') }}');

        $('#default_card').hide();

        $('#active_card').show();

        var who = document.getElementById('chatWithName');

        var inputWhoId = document.getElementById('convo_id');

        who.innerHTML = name;
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '{{url("/")}}/checkConvo/'+id,
            success: function(response){
                
                inputWhoId.value = response;
                
                loadMessagesOfThisConvo();
                
            },
            error: function(response){
                console.log(response);
            }
        });

        function loadMessagesOfThisConvo(){
            
            i=0;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '{{url("/")}}/loadMessage/'+id+'/'+authUser,
                success: function(response){
                    
                    $('#messageThread').html('');
                   
                    while(response[0][i]!=null)
                    {
                        if(response[1][0] == response[0][i].message_users_id )
                        {
                            $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+response[0][i].message +'</p></div></div>');
                        }
                        else
                        {
                            $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 float-left senderBox"><p>'+response[0][i].message +'</p></div></div>');
                        }

                        lastMessageId = response[0][i].id + 1;

                        i++;
                    }
                    scrollPaubos();

                    retrieveMessages();
                }
            });
        }
        function retrieveMessages(){
            i=0;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '{{url("/")}}/retrieveMessages/'+id+'/'+authUser+'/'+lastMessageId,
                success: function(response){
                    
                    while(response[i]!=null)
                    {
                        $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 float-left senderBox"><p>'+response[i].message +'</p></div></div>');

                        lastMessageId = response[i].id + 1;

                        i++;
                    }
                    scrollPaubos();
                },
                complete: function(){

                    setTimeout(function()
                    {
                        retrieveMessages();

                    }, 7000);
                    
                }
            });
        }
    }
    function submitMessage()
    {
        event.preventDefault();

        $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+$('#messsageInput').val()+'</p></div></div>');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '{{url("/")}}/sendMessage',
            data:{
                'convo_id': $('#convo_id').val(),
                'message': $('#messsageInput').val()
            },
            success: function(response){
               
            },
            error: function(response){
                console.log(error);
            }
        });
        $('#messsageInput').val('');

        scrollPaubos();
    }

</script>
@endsection

