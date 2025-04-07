<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset('favicon.ico')}}" />

<!-- themekit admin template asstes -->
<link rel="stylesheet" href="{{ asset('assets/all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/icon-kit/dist/css/iconkit.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/dist/css/ionicons.min.css') }}">

<!-- Stack array for including inline css or head elements -->
@stack('head')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- Datatable.css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}">

<script src="{{ asset('assets/js/app.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/js/custom.js') }}"></script>

