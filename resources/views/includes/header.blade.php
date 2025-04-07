@php
    $notifications = get_notifications();
@endphp

<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                
                <div class="header-search">
                    <div class="input-group">

                        <span class="input-group-addon search-close">
                            <i class="ik ik-x"></i>
                        </span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                    </div>
                </div>
                <button class="nav-link" title="clear cache">
                    <a  href="{{url('clear-cache')}}">
                    <i class="ik ik-battery-charging"></i> 
                </a>
                </button> &nbsp;&nbsp;
                <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ik ik-bell"></i>
                        @if($notifications->count() > 0)
                            <span class="badge bg-danger">{{ $notifications->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
                        <h4 class="header">{{ __('Notifications')}}@if($notifications->count() > 0)<a class="float-right" href="{{ route('notifications.markas') }}" title="Mark All as Read"><i class="fas fa-eye f-16"></i></a>@endif</h4>
                        <div class="notifications-wrap">
                            @foreach($notifications as $notification)
                                <a href="{{ route('notification.view', $notification->id) }}" class="media">
                                    <span class="d-flex">
                                        <i class="ik ik-check"></i> 
                                    </span>
                                    <span class="media-body">
                                        <span class="heading-font-family media-heading">{{ $notification->type }}</span> 
                                        <span class="media-content">{{ $notification->message}}</span>
                                        <span class="media-content text-primary f-12 float-right pt-1"><i>{{ time_interval($notification->created_at) }} ago</i></span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                        @if($notifications->count() > 0)
                            <div class="footer"><a href="{{ route('notifications.viewAll') }}">{{ __('View All')}}</a></div>
                        @else
                            <p class="footer">No new notifications</p>
                        @endif
                    </div>
                </div>
                <button type="button" class="nav-link ml-10 right-sidebar-toggle"><i class="ik ik-message-square"></i>
                    @if(unread_messages() > 0)
                        <span class="badge bg-success">{{ unread_messages() }}</span>
                    @endif
                </button>
                
                <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(auth()->user()->hasRole(['super-admin', 'admin']))
                            <img class="avatar" src="{{ asset('assets/images/admin.png')}}" alt="Image">
                        @else
                            <img class="avatar" src="{{ asset('assets/images/user.png')}}" alt="Image">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{url('profile')}}"><i class="ik ik-user dropdown-icon"></i> {{ __('Profile')}}</a>
                        <a class="dropdown-item" href="#"><i class="ik ik-navigation dropdown-icon"></i> {{ __('Message')}}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                <i class="ik ik-power dropdown-icon"></i>  {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>