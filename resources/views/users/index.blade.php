<x-app-layout>

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-inbox bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('All Users')}}</h5>
                            <span>{{ __('List of all users in a department')}}</span>
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
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @include('includes.message')
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ __('Users List')}}</h3>
                        @can('create user')
                            <a href="{{ route('users.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> New User
                            </a>
                        @endcan
                    </div>
                    <!-- New User Button -->
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>{{ __('#')}}</th>
                                    <th>{{ __('Full Name')}}</th>
                                    <th>{{ __('Email')}}</th>
                                    <th>{{ __('Phone')}}</th>
                                    <th>{{ __('Created At')}}</th>
                                    <th class="nosort">{{ __('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->fullNames() }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                @can('view user')
                                                    <a  href="{{ route('users.show', $user->id) }}"><i class="ik ik-eye f-16 text-primary mr-3"></i></a>
                                                @endcan

                                                @can('update user')
                                                    <a href="{{ route('users.edit', $user->id) }}"><i class="ik ik-edit f-16 text-green mr-3"></i></a>
                                                @endcan

                                                @can('delete user')
                                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('users.destroy', $user->id) }}" 
                                                            onclick="event.preventDefault();
                                                            if(confirm('Are you sure, you want to delete this record?'))
                                                                this.closest('form').submit();">
                                                            <i class="ik ik-trash-2 f-16 text-warning"></i>
                                                        </a>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <!-- <tfoot>
                                <tr>
                                    <th>{{ __('#')}}</th>
                                    <th>{{ __('Full Name')}}</th>
                                    <th>{{ __('Email')}}</th>
                                    <th>{{ __('Phone')}}</th>
                                    <th>{{ __('Created At')}}</th>
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

</x-app-layout>
