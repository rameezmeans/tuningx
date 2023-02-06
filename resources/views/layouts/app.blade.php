<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/newapp.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css" />

    {{-- <script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script> --}}
    <link rel="stylesheet" href="https://phpcoder.tech/multiselect/css/jquery.multiselect.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <style type="text/css">.tk-proxima-nova{font-family:"proxima-nova",sans-serif;}</style>
    <style>
        .clock {
            position: absolute;
            top: 4%;
            left: 58%;
            transform: translateX(-50%) translateY(-50%);
            font-size: 20px;
            font-family: Orbitron;
            letter-spacing: 7px;
        }

    </style>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @vite(['resources/js/app.js'])
    
    @yield('pagespecificstyles')
</head>
<body class="client-module">
    
    <div id="MyClockDisplay" style="color: #000;" class="clock" onload="showTime()"></div>
   

    @if (request()->has('success'))
        <div class="chip alert-message alert-green"><span><i class="fa fa-info-circle"></i>{{ __(request()->get('success')) }}<button class="close-message" style="background: transparent; margin-left: 20px; border: white 1px solid;">x</button></div>
    @endif

    @if (request()->has('error'))
        <div class="chip alert-message alert-red"><span><i class="fa fa-info-circle"></i>{{ __(request()->get('error')) }}<button class="close-message" style="background: transparent; margin-left: 20px; border: white 1px solid;">x</button></div>
    @endif        
    
    @yield('content')

    @yield('pagespecificscripts')
    <script type="text/javascript">

    function showTime(){
            // var date = new Date(new Date().toLocaleString('en', {timeZone: 'Europe/Athens'}));
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";
            
            if(h == 0){
                h = 12;
            }
            
            if(h > 12){
                h = h - 12;
                session = "PM";
            }
            
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            
            var time = h + ":" + m + ":" + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;
            
            setTimeout(showTime, 1000);
            
        }

    showTime();

        var icons;
        $( document ).ready(function(event) {

            $.ajax({
                url: "/get_tool_icons",
                type: "POST",
                async: false,
                data: {
                
                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    icons = response;
                }
            });

        });

        $(document).ready(function(e){

            $(document).on('click','.button-collapse', function(ev){
                if($(this).data('activates') == 'slide-menu'){
                    $('#slide-menu').css('transform','translateX(0%)');
                    $(this).data('activates', 'show');
                }
                else if($(this).data('activates') == 'show'){
                    $('#slide-menu').css('transform','translateX(-100%)');
                    $(this).data('activates', 'slide-menu');
                }
            });

            $(document).on('click','.close-message', function(ev){
                $(this).parent().parent().hide();
            });

            $(document).on('click','#language-btn', function(ev){
                $('#switch-language').toggleClass('hide');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <div id="switch-language" class="modal bottom-sheet no-print hide" style="z-index: 1005; opacity: 1; display: block; bottom: 0px;">
        <div class="modal-content center no-print">
            <h2>Select your language</h2>
            <a href="/language/en" class="chip">
                <img src="https://resellers.ecutech.tech/assets/img/flags/gb.svg" alt="England flag">
                English
            </a>
            <a href="/language/gr" class="chip">
                <img src="https://resellers.ecutech.tech/assets/img/flags/gr.svg" alt="Greece flag">
                Ελληνικά
            </a>
        </div>
    </div>
    
</body>
</html>
