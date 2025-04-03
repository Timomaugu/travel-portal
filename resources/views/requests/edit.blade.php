<x-app-layout>
<div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Update Request')}}</h5>
                            <span>{{ __('Edit requests')}}</span>
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
                        <h4>Edit Request</h4>
                        <a href="{{ route('requests.index') }}" class="btn btn-warning float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <!-- Form -->
                        <form method="POST" action="{{ route('requests.update', $requisition->id) }}">
                            @csrf
                            @method('PUT')

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
                                    <input id="destination" class="form-control" type="text" name="destination" value="{{ $requisition->destination }}" required autofocus autocomplete="destination" />
                                </div>
                                <!--Client Name -->
                                <div class="form-group">
                                    <label for="client">Client Name</label>
                                    <input id="client" class="form-control" type="text" name="client"  value="{{ $requisition->client }}" required autofocus autocomplete="client" />
                                </div>
                                <div class="row form-group">
                                <!-- Reason -->
                                <div class="col-sm">
                                    <label for="reason">Reason</label>
                                    <textarea id="reason" class="form-control" type="reason" name="reason" required autocomplete="textarea">{{ $requisition->reason }}</textarea>
                                </div>
                                <!-- Travel Mode -->
                                <div class="col-sm">
                                    <label for="travel_mode">Travel Mode</label>
                                    <select class="form-control" id="travel_mode" name="travel_mode">
                                        <option value="1" {{ ($requisition->travel_mode == 1) ? 'selected':'' }}>Land</option>
                                        <option value="2" {{ ($requisition->travel_mode == 2) ? 'selected':'' }}>Flight</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <!-- Need Accommodation -->
                                <div class="col-sm">
                                    <label for="accommodation" class="">{{ __('Accommodation') }}</label>
                                    <select id="accommodation" name="accommodation" value="" class="form-control">
                                        <option value="1" {{ ($requisition->accommodation == 1) ? 'selected':'' }}>{{ __('No') }}</option>
                                        <option value="2" {{ ($requisition->accommodation == 2) ? 'selected':'' }}>{{ __('Yes') }}</option>
                                    </select>
                                </div>
                                <!-- Travel Date -->
                                <div class="col-sm">
                                    <label for="trip_date">Trip Date</label>
                                    <input type="text" class="form-control datetimepicker-input" id="datepicker" name="trip_date" value="01/24/2025" data-toggle="datetimepicker" data-target="#datepicker" placeholder="Select Date">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>