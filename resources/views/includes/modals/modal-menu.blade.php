<div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="quick-search">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 ml-auto mr-auto">
                            <div class="input-wrap">
                                <input type="text" id="quick-search" class="form-control" placeholder="Search..." />
                                <i class="ik ik-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="container">
                    <div class="apps-wrap">
                        <div class="app-item">
                            <a href="#"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{ route('users.index') }}"><i class="ik ik-users"></i><span>{{ __('Users')}}</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{ route('requests.index') }}"><i class="ik ik-bell"></i><span>{{ __('Requests')}}</span></a>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-mail"></i><span>{{ __('Messages')}}</span></a>
                        </div>
                        <div class="app-item dropdown">
                            <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-command"></i><span>{{ __('Administration')}}</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/roles') }}">{{ __('Roles')}}</a>
                                <a class="dropdown-item" href="{{ url('/permissions') }}">{{ __('Permissions')}}</a>
                            </div>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-settings"></i><span>{{ __('Settings')}}</span></a>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-more-horizontal"></i><span>{{ __('More')}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>