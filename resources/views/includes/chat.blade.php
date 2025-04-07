@php
    $conversations = getConversations();
@endphp
<aside class="right-sidebar">
    <div class="sidebar-chat" data-plugin="chat-sidebar">
        <div class="sidebar-chat-info">
            <h6>{{ __('Chat List')}}</h6>
            <form class="mr-t-10">
                <div class="form-group">
                    <input type="text" id="searchChats" class="form-control" placeholder="Search for users ..."> 
                    <i class="ik ik-search"></i>
                </div>
            </form>
        </div>
        <div class="chat-list">
            <div class="list-group row">

                <a href="javascript:void(0)" class="list-group-item search hidden" data-chat-user="{{ __('John Doe') }}">
                    <figure class="user--online">
                        <img src="{{ asset('assets/images/user.png')}}" class="rounded-circle" alt="">
                    </figure>
                    <span>
                        <span class="name">{{ __('John Doe') }}</span>  
                        <div class="d-flex">
                            <span class="username mr-3">{{ date('d/m/Y') }}</span> 
                            <small>{{ date('h:i A') }}</small>
                        </div>
                        
                    </span>
                </a>
                
                @foreach($conversations as $conversation)
                    @if ($conversation->sender_id == auth()->id())
                        <a href="javascript:void(0)" class="list-group-item chats" data-chat-user="{{ $conversation->receiver->f_name }}">
                            <figure class="user--online">
                                <img src="{{ asset('assets/images/user.png')}}" class="rounded-circle" alt="">
                            </figure>
                            <span>
                                <span class="name">{{ $conversation->receiver->f_name  }} {{ $conversation->messages()->where('receiver_id', auth()->id())->where('read_at', NULL)->count() }}</span>  
                                <div class="d-flex">
                                    <span class="username mr-3">{{ substr($conversation->messages->last()->text, 0, 20) }}</span> 
                                    <small>{{ $conversation->messages->last()->created_at->format('d/m/Y') }}</small>
                                </div>
                                
                            </span>
                            <input type="hidden" class="conversation" value="{{ $conversation->id }}">
                            <input type="hidden" class="receiver" value="{{ $conversation->receiver_id }}">
                        </a>
                    @else
                    <a href="javascript:void(0)" class="list-group-item chats" data-chat-user="{{ $conversation->sender->f_name }}">
                        <figure class="user--online">
                            <img src="{{ asset('assets/images/user.png')}}" class="rounded-circle" alt="">
                        </figure>
                        <span>
                            <span class="name">{{ $conversation->sender->f_name  }} <span class="text-danger">{{ $conversation->messages()->where('receiver_id', auth()->id())->where('read_at', NULL)->count() }} </span></span>
                            <div class="d-flex">
                                <span class="username mr-3">{{ $conversation->messages->last()->text }}</span> 
                                <small>{{ $conversation->messages->last()->created_at->format('d/m/Y') }}</small>
                            </div>
                        </span>
                        <input type="hidden" class="conversation" value="{{ $conversation->id }}">
                        <input type="hidden" class="receiver" value="{{ $conversation->sender_id }}">
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</aside>
<div class="chat-panel" hidden>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <a href="javascript:void(0);"><i class="ik ik-message-square text-success"></i></a>  
            <span class="user-name">{{ __('John Doe')}}</span> 
            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="card-body">
            <div class="widget-chat-activity flex-1">
                <div class="messages">
                    <h6 class="text-center f-14">{{ __('Loading messages...') }}</h6>
                </div>
            </div>
        </div>
        <form action="" id="messageForm" class="card-footer" method="post">
            @csrf
            <div class="d-flex justify-content-end">
                <textarea class="border-0 flex-1" id="message" rows="1" placeholder="Type your message here"></textarea>
                <button class="btn btn-icon btn-send" type="button"><i class="ik ik-arrow-right text-success"></i></button>
            </div>
        </form>
    </div>
</div>


