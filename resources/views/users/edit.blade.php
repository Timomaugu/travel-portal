<x-app-layout>
<div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Update User')}}</h5>
                            <span>{{ __('Edit user, assign roles & permissions')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('users.index') }}">{{ __('Users')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Edit')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Edit User</h4>
                        <a href="{{ route('users.index') }}" class="btn btn-warning float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row form-group">
                                <div class="col-sm">
                                    <label for="fnmae">First Name<span class="text-red"> *</span></label>
                                    <input id="fname" type="name" placeholder="First Name" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ $user->f_name }}" required autocomplete="fname" autofocus>
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <label for="lname">Last Name<span class="text-red"> *</span></label>
                                    <input id="lname" type="name" placeholder="Last Name" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ $user->l_name }}" required autocomplete="lname" autofocus>
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  readonly>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <label for="phone">Phone<span class="text-red"> *</span></label>
                                    <input id="phone" type="phone" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm form-group">
                                    <label for="department">Department<span class="text-red"> *</span></label>
                                    <select id="department" class="form-control @error('department') is-invalid @enderror" name="department" autocomplete="department">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ ($user->department_id == $department->id) ? 'selected':'' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm">
                                    <label for="role">{{ __('Assign Role')}}<span class="text-red"> *</span></label>
                                    
                                    <select name="roles[]" class="form-control select2" multiple>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected':'' }} >
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>