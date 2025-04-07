! function(e, s, i) {
    "use strict";

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    document.addEventListener('click', function(event) {
        var $rightSidebar = document.getElementsByClassName('right-sidebar')[0],
            $chatPanel = document.getElementsByClassName('chat-panel')[0];
        var isInsideContainer = $rightSidebar.contains( event.target ) || $chatPanel.contains(event.target);
        if( !isInsideContainer ) {
          document.body.classList.remove('right-sidebar-expand');
          var toggle = document.getElementsByClassName('right-sidebar-toggle');
          for( var i = 0; i < toggle.length; i++ ) {
            toggle[i].classList.remove('active');
          }
          $chatPanel.hidden = 'hidden';
        }
    });

    // fetch messages
    function fetchMessages(conversationId) {
        $.ajax({
            url: `/messages/${conversationId}`,
            method: 'GET',
            success: function(messages) {
                $('.messages').empty(); 
                $('.messages').prepend(messages);

                var messages = el.find('.messages');
                messages[0].scrollTop = messages[0].scrollHeight;
                if( messages[0].classList.contains('scrollbar-enabled') ) {
                    messages.perfectScrollbar('update');
                }
                //console.log('success');
            }
        });
    }

    var el = $('[data-plugin="chat-sidebar"]');
    if( !el.length ) return;
    var chatList = el.find('.chat-list');
    let intervalId = null;
    
    chatList.each(function(index) {
        var $this = $(this);
        $(this).find('.list-group a').on('click', function() {
            $this.find('.list-group a.active').removeClass('active');
            $(this).addClass('active');

            var convId = $(this).find('.conversation').val();
            var el = $('.chat-panel');
            if(!el.length) return;
            el.removeAttr('hidden');

            clearInterval(intervalId);
            fetchMessages(convId);
            // Reload messages every 10 seconds
            if (convId != "0") {
                intervalId = setInterval(() => {
                    fetchMessages(convId);
                }, 10000);
            }
            
            el.find('.user-name').html( $(this).data('chat-user'));
        });
    });

    var el = $('.chat-panel');
    if(!el.length) return;
    el.find('.close').on('click', function(){
        clearInterval(intervalId);
        el.attr('hidden', true);
        el.find('.panel-body').removeClass('hide');
    });

    el.find('.minimize').on('click', function(){
        el.find('.card-block').attr('hidden', !el.find('.card-block').attr('hidden') );
        if( el.find('.card-block').attr('hidden') === 'hidden' )
            $(this).find('.material-icons').html('expand_less');
        else
        $(this).find('.material-icons').html('expand_more');
    });

    $('#searchChats').on('keyup', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        var el = $('[data-plugin="chat-sidebar"]');
        if( !el.length ) return;
        var searchList = el.find('.chat-list');

        $('#searchChats').on('keyup', function() {
            var searchTerm = $(this).val(); 
            if (searchTerm.length >= 3) { 
                $.ajax({
                    url: '/chats/find', 
                    type: 'POST',
                    data: { search: searchTerm }, 
                    success: function(users) {
                        // Display the users if any were found
                        if (users.length > 0) {
                            users.forEach(function(user) {

                                searchList.find('.list-group').append(searchList.find('.search'));
                                searchList.find('.list-group a').append('<input class="receiver_id" type="hidden" value="'+user.id+'"></input>');

                                searchList.find('.search').find('.name').html(user.f_name);
                                searchList.find('.search').attr('data-chat-user', user.f_name);

                            });
                            searchList.find('.search').removeClass('hidden');
                            searchList.find('.chats').addClass('hidden');

                        } else {
                            $('.list-group').append(searchList.find('.chats'));
                        }
                    },
                    error: function(error) {
                        console.error('Error searching users:', error);
                    }
                });
            } else {
                // If search term is less than 3 characters, show all
                searchList.find('.search').addClass('hidden');
                searchList.find('.chats').removeClass('hidden');
            }
        });
    });

    $('.btn-send').on('click', function () {

        var conversationId = $('.conversation_id').val();
        var receiverId = $('.receiver_id').val();
        //alert(conversationId); return;
        var message = $('#message').val();
        
        if (message == "") {
            alert('Enter Message')
            return;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            type: 'POST',
            url: '/messages/send',
            data: {
                conversation_id: conversationId, 
                receiver_id: receiverId, 
                message: message,
            },
            success: function(response) {
                $('#message').val('');
            },
            error: function(error) {
                console.error('Error :', error);
            }
        });
        
    })

    
}(window, document, jQuery);