<header>
    <div class="brand-logo hide-on-large-only">
                <img src="https://resellers.ecutech.tech/assets/img/ecutech/logo_white.png" alt="logo" class="responsive-img logo-mobile">
        </div>
    <div class="navbar-fixed hide-on-large-only">
        <nav>
            <div class="nav-wrapper">
                <ul class="right">
                    <li class="toogle-side-nav">
                        <a href="#" data-activates="slide-menu" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div id="slide-menu" class="side-nav fixed" data-simplebar-direction="vertical" style="transform: translateX(0%);">
        <ul class="side-nav-main">
             <li class="logo hide-on-med-and-down center">
                                  <img src="https://resellers.ecutech.tech//assets/img/ecutech/logo_white.png" alt="logo" class="responsive-img">
                          </li>
            <li class="side-nav-inline">
                <a href="{{ route('home'); }}" class="inline waves-effect tooltipped" data-tooltip="Dashboard" data-tooltip-id="ee8f5588-9e68-9616-9fd4-94ee79337d70">
                    <i class="fa fa-table-columns"></i>
                </a>
                <a href="#switch-language" class="modal-trigger inline waves-effect tooltipped" data-tooltip="Language" data-tooltip-id="fadf0895-13d2-6695-827b-a5139a3bd3b8" style="z-index: 1003;">
                    <i class="fa-solid fa-globe"></i>
                </a>

                <a onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" href="{{ route('logout'); }}" class="inline waves-effect tooltipped" data-tooltip="Logout" data-tooltip-id="e5a03688-582a-aef9-925b-060305f20995">
                   <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                
                <form id="logout-form" action="{{ route('logout'); }}" method="POST" class="d-none">@csrf</form>
            </li>
    
            <li class="active">
                <a href="{{ route('account'); }}" class="waves-effect">
                    <i class="fa-solid fa-user"></i>
                    <span>Account</span>
                    <span class="neutral badge">
                        {{ Auth::user()->credits->sum('credits') }} <small>credits</small>
                    </span>
                </a>
            </li>
                            <li class="">
                <a href="{{ route('file-upload') }}" class="waves-effect">
                    <i class="fa-solid fa-upload"></i><span>File Upload</span>
                </a>
            </li>
                    <li class="">
                <a href="{{ route('file-history'); }}" class="waves-effect">
                    <i class="fa-solid fa-clock-rotate-left"></i><span>File History</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('bosch-ecu')}}" class="waves-effect">
                    <span class="svg-icon logo-bosch"><!--?xml version="1.0" standalone="no"?-->
    
    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 646.000000 635.000000">
    <metadata>
    Created by potrace 1.16, written by Peter Selinger 2001-2019
    </metadata>
    <g transform="translate(0.000000,635.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
    <path d="M3135 6169 c-266 -9 -402 -30 -657 -99 -184 -50 -257 -77 -418 -150
    -662 -301 -1180 -806 -1488 -1450 -115 -242 -193 -486 -241 -755 -91 -520 -34
    -1075 165 -1577 145 -369 387 -734 679 -1023 257 -256 551 -456 882 -601 411
    -181 764 -256 1198 -256 282 0 522 35 826 118 164 45 529 208 685 305 420 264
    743 586 1000 999 89 144 209 383 254 509 116 319 176 629 187 966 5 178 3 203
    -38 530 -14 115 -95 409 -160 584 -54 143 -165 367 -251 504 -188 300 -461
    595 -763 824 -406 308 -974 525 -1475 563 -80 6 -158 12 -175 13 -16 1 -111 0
    -210 -4z m315 -379 c481 -41 840 -167 1245 -438 182 -122 368 -278 465 -393
    86 -101 218 -274 262 -344 195 -305 353 -736 389 -1062 33 -291 29 -470 -16
    -764 -24 -160 -114 -460 -186 -619 -305 -679 -829 -1157 -1534 -1403 -97 -33
    -352 -95 -485 -116 -110 -18 -454 -25 -560 -12 -239 29 -407 63 -545 108 -650
    212 -1142 603 -1470 1168 -159 274 -286 647 -332 975 -22 159 -22 482 1 660
    22 169 92 446 148 587 134 341 363 693 597 921 90 87 294 248 412 325 319 208
    733 358 1089 396 58 6 119 13 135 15 67 7 277 5 385 -4z"></path>
    <path d="M4280 4666 l0 -526 -1065 0 -1065 0 0 510 0 510 -148 -112 c-228
    -173 -360 -303 -514 -510 -96 -128 -234 -354 -271 -443 -104 -252 -160 -501
    -173 -775 -18 -381 60 -765 216 -1069 76 -148 183 -304 321 -466 164 -192 261
    -283 487 -454 l82 -62 0 451 0 450 1065 0 1065 0 0 -465 c0 -256 4 -465 8
    -465 5 0 26 15 48 33 21 18 89 68 149 111 282 201 429 352 622 641 88 131 125
    203 188 365 181 464 207 925 79 1403 -54 202 -74 258 -148 405 -156 311 -356
    556 -625 763 -87 68 -266 196 -308 223 -10 6 -13 -101 -13 -518z m493 -449
    c121 -180 154 -247 220 -454 64 -198 82 -319 80 -548 -2 -290 -38 -468 -152
    -746 -36 -89 -140 -259 -235 -383 l-36 -48 0 1176 c0 647 2 1176 4 1176 2 0
    56 -78 119 -173z m-2993 -1004 l-1 -1088 -23 28 c-43 54 -175 284 -200 351
    -35 92 -93 303 -112 406 -54 295 -26 606 82 930 24 74 60 163 79 197 42 77
    162 263 170 263 3 0 5 -489 5 -1087z m2460 -58 l0 -605 -1045 0 -1045 0 0 605
    0 605 1045 0 1045 0 0 -605z"></path>
    </g>
    </svg>
    </span><span>Bosch ECU Numbers</span>
                </a>
            </li>
                    
                    <li class="">
                <a href="{{ route('shop-product'); }}"><i class="fa-solid fa-cart-shopping"></i><span>Shop</span></a>
            </li>
            <li class="">
                <a href="{{route('invoices'); }}"><i class="fa-solid fa-file-invoice"></i><span>Invoices</span></a>
            </li>
            
                </ul>
    </div>
    </header>