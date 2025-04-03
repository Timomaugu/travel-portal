@php
    $conversations = getConversations();
@endphp
<aside class="right-sidebar">
    <div class="sidebar-chat" data-plugin="chat-sidebar">
        <div class="sidebar-chat-info">
            <h6>{{ __('Chat List')}}</h6>
            <form class="mr-t-10">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search for friends ..."> 
                    <i class="ik ik-search"></i>
                </div>
            </form>
        </div>
        <div class="chat-list">
            <div class="list-group row">
                @foreach($conversations as $conversation)
                    @if ($conversation->sender_id == Auth::id())
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="{{ $conversation->receiver->f_name }}">
                            <figure class="user--online">
                                <img src="{{ asset('assets/images/user.png')}}" class="rounded-circle" alt="">
                            </figure><span><span class="name">{{ $conversation->receiver->f_name  }}</span>  <span class="username">{{__('@').strtolower($conversation->receiver->f_name )}}_{{strtolower($conversation->receiver->l_name)}}</span> </span>
                        </a>
                    @else
                    <a href="javascript:void(0)" class="list-group-item" data-chat-user="{{ $conversation->sender->f_name }}">
                        <figure class="user--online">
                            <img src="{{ asset('assets/images/user.png')}}" class="rounded-circle" alt="">
                        </figure><span><span class="name">{{ $conversation->sender->f_name  }}</span>  <span class="username">{{__('@').strtolower($conversation->sender->f_name )}}_{{strtolower($conversation->sender->l_name)}}</span> </span>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</aside>
@php $messages = getMessages(1); @endphp
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
                    @foreach($messages as $message)
                        @if ($message->sender_id != auth()->id())
                            <div class="message media reply">
                                <figure class="user--online">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/admin.png')}}" class="rounded-circle" alt="">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>{{ $message->text }}</p>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @else
                            <div class="message media">
                                <figure class="user--online">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/user.png')}}" class="rounded-circle" alt="">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>{{ $message->text }}</p>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endif
                         
                        @php 
                            $conversationId = $message->conversation_id;
                            $receiverId = $message->receiver_id;
                        @endphp
                        
                    @endforeach
                </div>
            </div>
        </div>
        <form action="{{ route('message.send') }}" class="card-footer" method="post">
            @csrf
            <div class="d-flex justify-content-end">
                <input type="hidden" name="conversation_id" value="{{ $conversationId }}">
                <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
                <textarea class="border-0 flex-1" name="message" rows="1" placeholder="Type your message here"></textarea>
                <button class="btn btn-icon" type="submit"><i class="ik ik-arrow-right text-success"></i></button>
            </div>
        </form>
    </div>
</div>