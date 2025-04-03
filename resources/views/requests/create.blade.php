<x-app-layout>
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Make Request')}}</h5>
                            <span>{{ __('Make new travel request')}}</span>
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
                                <a href="{{ route('requests.index') }}">{{ __('Requests')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Submit')}}</a>
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
                        <h4>New Request</h4>
                        <a href="{{ route('requests.index') }}" class="btn btn-warning float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <!--  Form -->
                        <form method="POST" action="{{ route('requests.store') }}">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <!--Destination -->
                                <label for="destination">Destination</label>
                                <input id="destination" class="form-control" type="text" name="destination" value="{{ old('destination') }}" placeholder="Destination" required autofocus autocomplete="destination" />
                            </div>
                            <!--Client Name -->
                            <div class="form-group">
                                <label for="client">Client Name</label>
                                <input id="client" class="form-control" type="text" name="client"  value="{{ old('client') }}" placeholder="Client" required autocomplete="client" />
                            </div>
                            <div class="row form-group">
                                <!-- Reason -->
                                <div class="col-sm">
                                    <label for="reason">Reason</label>
                                    <textarea id="reason" class="form-control" type="reason" name="reason"  value="{{ old('reason') }}" required autocomplete="textarea" placeholder="Type your text here..."></textarea>
                                </div>
                                <!-- Travel Mode -->
                                <div class="col-sm">
                                    <label for="travel_mode">Travel Mode</label>
                                    <select class="form-control" id="travel_mode" name="travel_mode" value="{{ old('travel_mode') }}">
                                        <option value="1" selected>Land</option>
                                        <option value="2">Flight</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <!-- Need Accommodation -->
                                <div class="col-sm">
                                    <label for="accommodation" class="">{{ __('Accommodation') }}</label>
                                    <select id="accommodation" name="accommodation" value="{{ old('accommodation') }}" class="form-control">
                                        <option value="1">{{ __('No') }}</option>
                                        <option value="2">{{ __('Yes') }}</option>
                                    </select>
                                </div>
                                <!-- Travel Date -->
                                <div class="col-sm">
                                    <label for="trip_date">Trip Date</label>
                                    <input type="text" class="form-control datetimepicker-input" id="datepicker" name="trip_date" data-toggle="datetimepicker" data-target="#datepicker" placeholder="Select Date">
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>