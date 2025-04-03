<x-app-layout>

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-inbox bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Permissions')}}</h5>
                            <span>{{ __('List of permissions for roles')}}</span>
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
                                <a href="{{ url('/permisssions') }}">Permissions</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ __('Permissions List')}}</h3>

                        @can('create permission')
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>New Permission</a>
                        @endcan
                    </div>
                    <!-- New User Button -->
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <div class="d-flex float-right">
                                                @can('update permission')
                                                    <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="py-3 mr-3"><i class="ik ik-edit f-16 text-success"></i></a>
                                                @endcan

                                                @can('delete permission')
                                                    <form method="POST" class="py-3" action="{{ route('permissions.destroy', $permission->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('permissions.destroy', $permission->id) }}"
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>