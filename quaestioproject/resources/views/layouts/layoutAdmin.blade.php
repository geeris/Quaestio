<!DOCTYPE html>
<html>
@include('fixed.head')

<body>
@include('fixed.navigation')

@include('.fixed.navigationForAdmins')

@yield('content')

@include('fixed.footer')
@include('fixed.scripts')
</body>
