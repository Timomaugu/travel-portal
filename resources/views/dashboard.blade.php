<x-app-layout>
    <x-slot name="header">
        <span class="text-lg text-gray-600 leading-tight">
            {{ __('Dashboard') }}
        </span>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
    		<!-- page statustic chart start -->
            @if(auth()->user()->hasRole(['super-admin', 'admin', 'hod-agm-gm']))
                <div class="col-xl-3 col-md-6">
                    <div class="card card-blue text-white">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="mb-0">{{ $users }}</h4>
                                    <p class="mb-0">{{ __('Total Users')}}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="ik ik-user f-30"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ $approved }}</h4>
                                <p class="mb-0">{{ __('Approved Requests')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-check-circle f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ $pending }}</h4>
                                <p class="mb-0">{{ __('Pending Requests')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-rotate-ccw f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ $rejected }}</h4>
                                <p class="mb-0">{{ __('Rejected Requests')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-ban f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</x-app-layout>
