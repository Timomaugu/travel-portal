<x-app-layout>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-inbox bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('All Requests')}}</h5>
                            <span>{{ __('List of all requests in a department')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('requests.index') }}">Requests</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @php
            $user = auth()->user();
            $requisitions = get_requisitions('');
        @endphp

        <div class="row">
            <div class="col-sm-12">
                @include('includes.message');
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ __('Requests List')}}</h3>
                        <!-- New Request Button -->
                         @can('create request')
                            <a class="btn btn-success" href="{{ route('requests.create') }}">
                                <i class="fas fa-plus"></i> {{ __('New Request') }}
                            </a>
                        @endcan
                    </div>
                    
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('#')}}</th>
                                        <th>{{ __('Requested By')}}</th>
                                        <th>{{ __('Destination')}}</th>
                                        <th>{{ __('Client Name')}}</th>
                                        <th>{{ __('Reason')}}</th>
                                        <th>{{ __('Travel Mode')}}</th>
                                        <th>{{ __('Accommodation Needed')}}</th>
                                        <th>{{ __('Trip Date')}}</th>
                                        <th>{{ __('Status')}}</th>
                                        <th>{{ __('Request Date')}}</th>
                                        <th class="nosort">{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisitions as $requisition)
                                        <tr data-id="{{ $requisition->id }}">
                                            <td>{{ $requisition->id }}</td>
                                            <td>{{ $requisition->user->f_name }} {{ $requisition->user->l_name }}</td>
                                            <td>{{ $requisition->destination }}</td>
                                            <td>{{ $requisition->client }}</td>
                                            <td>{{ $requisition->reason }}</td>
                                            <td>{{ ($requisition->travel_mode == 1) ? 'Land'  : 'Flight'}}</td>
                                            <td>{{ ($requisition->accommodation == 0) ? 'No' : 'Yes' }}</td>
                                            <td>{{ date_create($requisition->trip_date)->format('d M Y') }}</td>
                                            <td><span class="badge {{ ($requisition->status == '0') ? 'badge-warning': '' }} {{ ($requisition->status == '1') ? 'badge-success': '' }} {{ ($requisition->status == '2') ? 'badge-danger': '' }}">{{ ($requisition->status == '0') ? 'Pending': '' }} {{ ($requisition->status == '1') ? 'Approved': '' }} {{ ($requisition->status == '2') ? 'Rejected': '' }}</span></td>
                                            <td>{{ $requisition->created_at->format('d M Y h:i:s') }}</td>
                                            <td>
                                                <div class="d-flex float-right">
                                                    @can('view request')
                                                        <a href="#"><i class="ik ik-eye f-16 text-primary"></i></a>
                                                    @endcan

                                                    @if($requisition->status == 0)
                                                        @if($user->hasRole('staff') || ($user->hasRole('hod-agm-gm') && $requisition->hod_agm_gm_approved == 0) || ($user->hasRole('director') && $requisition->director_approved == 0) || ($user->hasRole('ceo') && $requisition->ceo == 0) || $user->hasRole('super-admin'))
                                                            @can('update request')
                                                                <a href="{{ route('requests.edit', $requisition->id) }}" class="mx-2"><i class="ik ik-edit f-16 text-success"></i></a>
                                                            @endcan

                                                            @can('delete request')
                                                                <form method="POST" action="{{ route('requests.destroy', $requisition->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="{{ route('requests.destroy', $requisition->id) }}" 
                                                                        onclick="event.preventDefault();
                                                                        if(confirm('Are you sure, you want to delete this record?'))
                                                                        this.closest('form').submit();">
                                                                        <i class="ik ik-trash-2 f-16 text-warning"></i>
                                                                    </a>
                                                                </form>
                                                            @endcan

                                                            @can('process request')
                                                                <button type="button" data-toggle="modal" data-target="#approveModal" class="btn btn-success btn-sm btn-approve ml-2"><i class="ik ik-check-circle" aria-hidden="true"></i>Approve</button>
                                                                <button type="button" id="btn-reject" data-toggle="modal" data-target="#rejectModal" class="btn btn-danger btn-sm btn-reject mx-2"><i class="fas fa-times" aria-hidden="true"></i>Decline</button>
                                                                @if($user->hasRole(['super-admin', 'hod-agm-gm', 'director']))
                                                                    <button type="button" data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">Forward <i class="fas fa-arrow-circle-right"></i></button>
                                                                @endif
                                                                <div class="dropdown-menu">
                                                                    @if($user->hasRole(['super-admin', 'hod-agm-gm']))
                                                                        <a class="dropdown-item" href="{{ route('request.forward', [$requisition->id, 1]) }}">To Director</a>
                                                                    @endif
                                                                        <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="{{ route('request.forward', [$requisition->id, 2]) }}">To CEO</a>
                                                                </div>
                                                            @endcan
                                                        @else
                                                            @if($requisition->hod_agm_gm_approved == 3 || $requisition->director_approved == 3)
                                                                <button class="btn btn-info btn-sm"><i class="ik ik-check-circle" aria-hidden="true"></i>Forwarded</button>
                                                            @else
                                                                <button class="btn btn-success btn-sm mx-2"><i class="ik ik-check-circle" aria-hidden="true"></i>Processed</button>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <button class="btn btn-success btn-sm mx-2"><i class="ik ik-check-circle" aria-hidden="true"></i>Processed</button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!-- <tfoot>
                                <tr>
                                    <th>{{ __('#')}}</th>
                                    <th>{{ __('Requested By')}}</th>
                                    <th>{{ __('Destination')}}</th>
                                    <th>{{ __('Client Name')}}</th>
                                    <th>{{ __('Reason')}}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th>{{ __('Date')}}</th>
                                    <th class="nosort">{{ __('Action')}}</th>
                                </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Request Modal -->
    @include('includes.modals.modal-approve')

    <!-- Reject Request Modal -->
    @include('includes.modals.modal-reject')

</x-app-layout>
