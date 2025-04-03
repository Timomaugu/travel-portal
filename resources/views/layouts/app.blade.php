<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title', 'Travel') | Portal</title>
    <!-- initiate head with meta tags, css and script -->
    @include('includes.head')

</head>

<body id="app">
    <div class="wrapper">
        <!-- header -->
        @include('includes.header')
        <div class="page-wrap">
            <!-- sidebar -->
            @include('includes.sidebar')

            <div class="main-content">
                <!-- content -->
                {{ $slot }}
            </div>

            <!-- chat section -->
            @include('includes.chat')

            <!-- footer section -->
            @include('includes.footer')

        </div>
    </div>

    <!-- modal menu section -->
    @include('includes.modals.modal-menu')

    <!-- scripts -->
    @include('includes.script')
</body>

</html>