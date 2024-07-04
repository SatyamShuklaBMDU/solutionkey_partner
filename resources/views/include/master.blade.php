<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpg">
    <title>Document</title>
    <style>
        body { margin: 0; overflow: hidden; }
        #hoverCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        a:hover {
            color: red;
            position: relative;
        }

        a:hover::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background: red;
            animation: underline-animation 0.3s forwards;
        }

        @keyframes underline-animation {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }
    </style>
    @include('include.head')
    @vite('resources/js/firstThree.js')
    @yield('style-area')
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
    <canvas id="hoverCanvas"></canvas>
    {{-- Footer --}}
    <script src="{{ asset('js/navbar.js') }}"></script>
</body>
@include('include.footer')
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

</html>
