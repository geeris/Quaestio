<!DOCTYPE html>
<html>
    @include('fixed.head')

<body>
    @include('fixed.navigation')
    @include('.fixed.navigationForUsers')

    @yield('content')

    @include('fixed.footer')
    @include('fixed.scripts')
</body>
