<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @yield('style-area')
    @include('include.head')
</head>

<body>
    {{-- Header --}}
    @include('include.header')
    
    {{-- Sidebar --}}
    @include('include.sidebar')
    
    <div class="container-fluid">
            {{-- Content --}}
            @yield('content')
    </div>
    {{-- Footer --}}
    <script src="{{ asset('js/navbar.js') }}"></script>
</body>
@yield('script-area')
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
@include('include.footer')

</html>
