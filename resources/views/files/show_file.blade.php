@extends('layouts.file_layout')

@section('pagespecificstyles')

<style>

.tab .tablinks .wow  i {
    display: block;
    font-size: 1.5em;
}

#ecu_file_select + ul + span{
    display: none;
}

#gearbox_file_select + ul + span{
    display: none;
}

.tab .tablinks .wow  span {
    display: block;
}

.tab .tablinks .wow  small {
    display: block;
}

.tablinks-smaller {
    height: 50px;
    width: 50% !important;
}

 /* Style the tab */
 .tab {
  /* overflow: hidden; */
  
  color: #f02429;
  background-color: #fff;
    box-shadow: none;
    display: flex;
    font-size: 16px;
    height: 100px;
    margin: 0 auto;
    overflow-x: auto;
    overflow-y: hidden;
    position: relative;
    white-space: nowrap;
    width: 100%;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  width: 34%;
}

/* Change background color of buttons on hover */
.tab button:hover {
  border-bottom: #f02429 2px solid;
}

/* Create an active/current tablink class */
.tab button.active {
    border-bottom: #f02429 2px solid;
}

/* Style the tab content */
.tabcontent {
    background-color: #fff;
    display: none;
    padding: 6px 12px;
    border-top: none;
    margin-top:5px;
}


.feedback {
	 --normal: #eceaf3;
	 --normal-shadow: #d9d8e3;
	 --normal-mouth: #9795a4;
	 --normal-eye: #595861;
	 --active: #f8da69;
	 --active-shadow: #f4b555;
	 --active-mouth: #f05136;
	 --active-eye: #313036;
	 --active-tear: #76b5e7;
	 --active-shadow-angry: #e94f1d;
	 margin: auto;
     width: 50%;
	 padding: 0;
	 list-style: none;
	 display: flex;
}
 .feedback li {
     padding: 0 !important;
	 position: relative;
	 border-radius: 50%;
	 background: var(--sb, var(--normal));
	 box-shadow: inset 3px -3px 4px var(--sh, var(--normal-shadow));
	 transition: background 0.4s, box-shadow 0.4s, transform 0.3s;
	 -webkit-tap-highlight-color: transparent;
}
 .feedback li:not(:last-child) {
	 margin-right: 20px;
}
 .feedback li div {
	 width: 40px;
	 height: 40px;
	 position: relative;
	 transform: perspective(240px) translateZ(4px);
}
 .feedback li div svg, .feedback li div:before, .feedback li div:after {
	 display: block;
	 position: absolute;
	 left: var(--l, 9px);
	 top: var(--t, 13px);
	 width: var(--w, 8px);
	 height: var(--h, 2px);
	 transform: rotate(var(--r, 0deg)) scale(var(--sc, 1)) translateZ(0);
}
 .feedback li div svg {
	 fill: none;
	 stroke: var(--s);
	 stroke-width: 2px;
	 stroke-linecap: round;
	 stroke-linejoin: round;
	 transition: stroke 0.4s;
}
 .feedback li div svg.eye {
	 --s: var(--e, var(--normal-eye));
	 --t: 17px;
	 --w: 7px;
	 --h: 4px;
}
 .feedback li div svg.eye.right {
	 --l: 23px;
}
 .feedback li div svg.mouth {
	 --s: var(--m, var(--normal-mouth));
	 --l: 11px;
	 --t: 23px;
	 --w: 18px;
	 --h: 7px;
}
 .feedback li div:before, .feedback li div:after {
	 content: '';
	 z-index: var(--zi, 1);
	 border-radius: var(--br, 1px);
	 background: var(--b, var(--e, var(--normal-eye)));
	 transition: background 0.4s;
}
 .feedback li.angry {
	 --step-1-rx: -24deg;
	 --step-1-ry: 20deg;
	 --step-2-rx: -24deg;
	 --step-2-ry: -20deg;
}
 .feedback li.angry div:before {
	 --r: 20deg;
}
 .feedback li.angry div:after {
	 --l: 23px;
	 --r: -20deg;
}
 .feedback li.angry div svg.eye {
	 stroke-dasharray: 4.55;
	 stroke-dashoffset: 8.15;
}
 .feedback li.angry.active {
	 animation: angry 1s linear;
}
 .feedback li.angry.active div:before {
	 --middle-y: -2px;
	 --middle-r: 22deg;
	 animation: toggle 0.8s linear forwards;
}
 .feedback li.angry.active div:after {
	 --middle-y: 1px;
	 --middle-r: -18deg;
	 animation: toggle 0.8s linear forwards;
}
 .feedback li.sad {
	 --step-1-rx: 20deg;
	 --step-1-ry: -12deg;
	 --step-2-rx: -18deg;
	 --step-2-ry: 14deg;
}
 .feedback li.sad div:before, .feedback li.sad div:after {
	 --b: var(--active-tear);
	 --sc: 0;
	 --w: 5px;
	 --h: 5px;
	 --t: 15px;
	 --br: 50%;
}
 .feedback li.sad div:after {
	 --l: 25px;
}
 .feedback li.sad div svg.eye {
	 --t: 16px;
}
 .feedback li.sad div svg.mouth {
	 --t: 24px;
	 stroke-dasharray: 9.5;
	 stroke-dashoffset: 33.25;
}
 .feedback li.sad.active div:before, .feedback li.sad.active div:after {
	 animation: tear 0.6s linear forwards;
}
 .feedback li.ok {
	 --step-1-rx: 4deg;
	 --step-1-ry: -22deg;
	 --step-1-rz: 6deg;
	 --step-2-rx: 4deg;
	 --step-2-ry: 22deg;
	 --step-2-rz: -6deg;
}
 .feedback li.ok div:before {
	 --l: 12px;
	 --t: 17px;
	 --h: 4px;
	 --w: 4px;
	 --br: 50%;
	 box-shadow: 12px 0 0 var(--e, var(--normal-eye));
}
 .feedback li.ok div:after {
	 --l: 13px;
	 --t: 26px;
	 --w: 14px;
	 --h: 2px;
	 --br: 1px;
	 --b: var(--m, var(--normal-mouth));
}
 .feedback li.ok.active div:before {
	 --middle-s-y: 0.35;
	 animation: toggle 0.2s linear forwards;
}
 .feedback li.ok.active div:after {
	 --middle-s-x: 0.5;
	 animation: toggle 0.7s linear forwards;
}
 .feedback li.good {
	 --step-1-rx: -14deg;
	 --step-1-rz: 10deg;
	 --step-2-rx: 10deg;
	 --step-2-rz: -8deg;
}
 .feedback li.good div:before {
	 --b: var(--m, var(--normal-mouth));
	 --w: 5px;
	 --h: 5px;
	 --br: 50%;
	 --t: 22px;
	 --zi: 0;
	 opacity: 0.5;
	 box-shadow: 16px 0 0 var(--b);
	 filter: blur(2px);
}
 .feedback li.good div:after {
	 --sc: 0;
}
 .feedback li.good div svg.eye {
	 --t: 15px;
	 --sc: -1;
	 stroke-dasharray: 4.55;
	 stroke-dashoffset: 8.15;
}
 .feedback li.good div svg.mouth {
	 --t: 22px;
	 --sc: -1;
	 stroke-dasharray: 13.3;
	 stroke-dashoffset: 23.75;
}
 .feedback li.good.active div svg.mouth {
	 --middle-y: 1px;
	 --middle-s: -1;
	 animation: toggle 0.8s linear forwards;
}
 .feedback li.happy div {
	 --step-1-rx: 18deg;
	 --step-1-ry: 24deg;
	 --step-2-rx: 18deg;
	 --step-2-ry: -24deg;
}
 .feedback li.happy div:before {
	 --sc: 0;
}
 .feedback li.happy div:after {
	 --b: var(--m, var(--normal-mouth));
	 --l: 11px;
	 --t: 23px;
	 --w: 18px;
	 --h: 8px;
	 --br: 0 0 8px 8px;
}
 .feedback li.happy div svg.eye {
	 --t: 14px;
	 --sc: -1;
}
 .feedback li.happy.active div:after {
	 --middle-s-x: 0.95;
	 --middle-s-y: 0.75;
	 animation: toggle 0.8s linear forwards;
}
 .feedback li:not(.active) {
	 cursor: pointer;
}
 .feedback li:not(.active):active {
	 transform: scale(0.925);
}
 .feedback li.active {
	 --sb: var(--active);
	 --sh: var(--active-shadow);
	 --m: var(--active-mouth);
	 --e: var(--active-eye);
}
 .feedback li.active div {
	 animation: shake 0.8s linear forwards;
}
 @keyframes shake {
	 30% {
		 transform: perspective(240px) rotateX(var(--step-1-rx, 0deg)) rotateY(var(--step-1-ry, 0deg)) rotateZ(var(--step-1-rz, 0deg)) translateZ(10px);
	}
	 60% {
		 transform: perspective(240px) rotateX(var(--step-2-rx, 0deg)) rotateY(var(--step-2-ry, 0deg)) rotateZ(var(--step-2-rz, 0deg)) translateZ(10px);
	}
	 100% {
		 transform: perspective(240px) translateZ(4px);
	}
}
 @keyframes tear {
	 0% {
		 opacity: 0;
		 transform: translateY(-2px) scale(0) translateZ(0);
	}
	 50% {
		 transform: translateY(12px) scale(0.6, 1.2) translateZ(0);
	}
	 20%, 80% {
		 opacity: 1;
	}
	 100% {
		 opacity: 0;
		 transform: translateY(24px) translateX(4px) rotateZ(-30deg) scale(0.7, 1.1) translateZ(0);
	}
}
 @keyframes toggle {
	 50% {
		 transform: translateY(var(--middle-y, 0)) scale(var(--middle-s-x, var(--middle-s, 1)), var(--middle-s-y, var(--middle-s, 1))) rotate(var(--middle-r, 0deg));
	}
}
 @keyframes angry {
	 40% {
		 background: var(--active);
	}
	 45% {
		 box-shadow: inset 3px -3px 4px var(--active-shadow), inset 0 8px 10px var(--active-shadow-angry);
	}
}

.f-dropdown {
  --max-scroll: 3;
  position: relative;
  z-index: 10;
}
.f-dropdown select {
  display: none;
}
.f-dropdown > span {
  cursor: pointer;
  padding: 8px 12px;
  border-radius: 6px;
  display: flex;
  align-items: center;
  position: relative;
  color: #bbb;
  border: 1px solid #ccc;
  background: #fff;
  transition: color 0.2s ease, border-color 0.2s ease;
  border-radius: 6px;
    box-shadow: 0 8px 20px 0 rgb(73 76 83 / 20%);
}

.f-dropdown ul li a span {
    font-size: 12px;
}
.f-dropdown > span > span {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding-right: 12px;
  font-size: 12px;
}
.f-dropdown > span img {
  width: 30px;
  margin-right: 10px;
}
.f-dropdown > span:before, .f-dropdown > span:after {
  content: "";
  display: block;
  position: absolute;
  width: 8px;
  height: 2px;
  border-radius: 1px;
  top: 50%;
  right: 12px;
  background: #000;
  transition: all 0.3s ease;
}
.f-dropdown > span:before {
  margin-right: 4px;
  transform: scale(0.96, 0.8) rotate(50deg);
}
.f-dropdown > span:after {
  transform: scale(0.96, 0.8) rotate(-50deg);
}
.f-dropdown ul {
  margin: 0;
  padding: 0;
  list-style: none;
  opacity: 0;
  visibility: hidden;
  position: absolute;
  max-height: calc(var(--max-scroll) * 75px);
  top: 30px;
  left: 0;
  z-index: 1;
  right: 0;
  background: #FFF;
  border: 1px solid #CCC;
  border-radius: 6px;
  overflow-x: hidden;
  overflow-y: auto;
  transform-origin: 0 0;
  transition: opacity 0.2s ease, visibility 0.2s ease, transform 0.3s cubic-bezier(0.4, 0.6, 0.5, 1.32);
  transform: translate(0, 5px);
}
.f-dropdown ul li {
  padding: 0;
  margin: 0;
}
.f-dropdown ul li a {
  cursor: pointer;
  display: block;
  padding: 8px 12px;
  color: #000;
  text-decoration: none;
  outline: none;
  position: relative;
  transition: all 0.2s ease;
  align-items: center;
}
.f-dropdown ul li a img {
  width: auto;
  height: 40px;
  float: right;
}
.f-dropdown ul li a:hover {
  color: #5C6BC0;
}
.f-dropdown ul li.active a {
  color: #FFF;
  background: lightgrey;
}
.f-dropdown ul li.active a:before, .f-dropdown ul li.active a:after {
  --scale: 0.6;
  content: "";
  display: block;
  width: 10px;
  height: 2px;
  position: absolute;
  right: 12px;
  top: 50%;
  opacity: 0;
  background: #FFF;
  transition: all 0.2s ease;
}
.f-dropdown ul li.active a:before {
  transform: rotate(45deg) scale(var(--scale));
}
.f-dropdown ul li.active a:after {
  transform: rotate(-45deg) scale(var(--scale));
}
.f-dropdown ul li.active a:hover:before, .f-dropdown ul li.active a:hover:after {
  --scale: 0.9;
  opacity: 1;
}
.f-dropdown ul li:first-child a {
  border-radius: 6px 6px 0 0;
}
.f-dropdown ul li:last-child a {
  border-radius: 0 0 6px 6px;
}
.f-dropdown.disabled {
  opacity: 0.7;
}
.f-dropdown.disabled > span {
  cursor: not-allowed;
}
.f-dropdown.filled > span {
  color: #000;
}
.f-dropdown.open {
  z-index: 15;
}
.f-dropdown.open > span {
  border-color: #AAA;
}
.f-dropdown.open > span:before, .f-dropdown.open > span:after {
  background: #000;
}
.f-dropdown.open > span:before {
  transform: scale(0.96, 0.8) rotate(-50deg);
}
.f-dropdown.open > span:after {
  transform: scale(0.96, 0.8) rotate(50deg);
}
.f-dropdown.open ul {
  opacity: 1;
  visibility: visible;
  transform: translate(0, 12px);
  transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s cubic-bezier(0.4, 0.6, 0.5, 1.32);
}

/* --------------------------- */
.f-group {
  max-width: 250px;
  margin: 0 auto;
  text-align: left;
}
.f-group select {
  width: 100%;
}

.f-control {
  font-size: 14px;
  line-height: normal;
  color: #000;
  display: inline-block;
  background-color: #ffffff;
  border: #ccc 1px solid;
  border-radius: 6px;
  padding: 8px 12px;
  outline: none;
  max-width: 250px;
}

/* label {
  width: 100%;
  display: block;
  font-weight: bold;
  margin-bottom: 10px;
  text-align: center;
} */

body {
  /* font-family: Arial, sans-serif;
  font-size: 14px;
  padding: 80px 10px;
  background: #e3f3ff; */
}

</style>

@endsection


@section('content')

<main>
    <div class="header-id-overlay hide-on-med-and-down"></div>
    <section>
        <div class="parallax-container hide-on-med-and-down">
            <a href="{{route('file-history')}}" class="modal-action modal-close corner-right" aria-label="Close">
        <span aria-hidden="true">
            <div class="close-icon">
                <span></span>
                <span></span>
            </div>
        </span>
            </a>
            <a href="{{route('file-history')}}" class="modal-action modal-close corner-left" aria-label="Close">
        <span aria-hidden="true">
            <div class="close-icon">
                <span></span>
                <span></span>
            </div>
        </span>
            </a>
            <a class="scroll-animation active" href="#content">
                <div class="mouse"></div>
                <div class="arrow-scroll">
                    <span></span>
                    <span></span>
                </div>
            </a>
            <div class="parallax">
                <img src="https://www.shiftech.eu/media/models/engines/a0975f1f42b671fa18e562c980682ca7.jpg" style="display: block; /*transform: translate3d(-50%, 659px, 0px);*/">
            </div>
        </div>
    </section>
    <div id="content">
        <div class="row header-vehicle-id z-depth-1">
            <div class="container">
                <div class="col s7 m8 l8">
                    <h1>Individual history</h1>
                                        </div>
                <div class="col s5 m4 l4 center">
                    <a class="btn btn-red waves-effect waves-light btn-vehicle-id" id="back-vehicle-id" href="/en/client/file-history"><span class="hide-on-med-and-down">Back to history</span>
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" style="margin: 0px">
                <div class="col s12 m12 l7">

                <!-- Tab links -->
                <div class="timeline block-content-full">
                <div class="tab timeline-actions z-depth-1">
                    <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">
                        <div class="wow" style="visibility: visible !important;">
                            <i class="fa fa-cloud-upload"></i>
                            <span>
                                New request
                            </span>
                            <small>Upload new read file</small>
                        </div>
                    
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'Paris')">
                        
                        <div class="wow" style="visibility: visible !important;">
                            <i class="fa fa-headset"></i>
                            <span>
                                Help
                            </span>
                            <small>Get in touch with the engineer</small>
                        </div>
    
                </button>
                    <button class="tablinks" onclick="openCity(event, 'Tokyo')">
                        <div class="wow" style="visibility: visible !important;">
                            <i class="fa fa-calendar"></i>
                            <span>
                                Internal event
                            </span>
                            <small>Add new internal event</small>
                        </div>
                    </button>
                </div>
                
                <!-- Tab content -->
                <div id="London" class="tabcontent timeline-actions z-depth-1">
                    <form method="POST" action="{{ route('request-file') }}" enctype="multipart/form-data">
                    <div class="tab-content">
                        @if ($message = Session::get('success'))
                            <div style="background: #28a745!important; padding: 10px;">
                                <span style="margin:0; color:white;">{{ $message }}</span>
                                <i class="fa fa-close close-message" style="float:right; margin-top:2px; color:white;"></i>
                            </div>
                        @endif
                    <label style="font-size: 16px;">Send a new file request</label>
                    
                        @csrf
                        <input type="hidden" id="file_type" name="file_type" value="">
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                        <div class="row mt-5">

                            <h3 style="margin-left:12px;">Select File Type</h3>
                            {{-- <div class="input-field col s12" style="margin-left:5px; display:flex;"> --}}
                                <div class="col s12 m4 file-type-buttons">
                                    <label class="file-type-label col s6">
                                        <input type="radio" value="ECU" class="file-selection file_type" name="file_type">
                                            <img src="https://resellers.ecutech.tech/assets/img/OLSx-pictogram-file-02.svg">
                                            <span>
                                                ECU file
                                            </span>
                                    </label>
                                    <label class="file-type-label col s6">
                                        <input type="radio" value="TCU" class="file-selection file_type" name="file_type">
                                        <img src="https://resellers.ecutech.tech/assets/img/OLSxGearBox.svg">
                                        <span>
                                            Gearbox file
                                        </span>
                                    </label>

                                    @error('file_type')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                                {{-- <div class="col s6" style="display: flex;">
                                    <span class="file_type_area" style="padding: 20px;" data-type="ecu_file">
                                        <div><img src="https://resellers.ecutech.tech/assets/img/OLSx-pictogram-file-02.svg"></div>
                                        <p>ECU File</p>
                                    </span>
                                    <span style="margin-left: 10px; padding: 20px;" class="file_type_area" data-type="gearbox_file">
                                        <div><img src="https://resellers.ecutech.tech/assets/img/OLSxGearBox.svg"></div>
                                        <p>Gearbox File</p>
                                    </span>
                                    @error('file_type')
                                        <p class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div> --}}
                                <div class="col s6" style="float: right !important;">
                                    <div class="select-wrapper form-control">
                                        <select name="ecu_file_select" id="ecu_file_select" class="select-dropdown  f-dropdown hide">
                                            <option value="status" selected disabled>Request Type </option>
                                            <option value="new_upload">New upload</option>
                                            <option value="tuning_evolution">Tuning Evolution - I want to make a new tuning request.</option>
                                            <option value="back_to_tuned">Back to tuned - The car has been updated by the dealer, please renew the tuning.</option>
                                            <option value="back_to_stock">Back to stock - Send me back the original version.</option>
                                            <option value="back_to_stock_with_virtual_read">Back to stock with virtual read - Its a virtual read, can you send me this file back to flash the car in stock mode?</option>
                                            <option value="problem_RMA">Problem - RMA - I've an issue with this file, can you check?</option>
                                        </select>
                                    </div>
                                    <div class="select-wrapper form-control">
                                        <select name="gearbox_file_select" id="gearbox_file_select" class="select-dropdown  f-dropdown hide">
                                            <option value="status" selected disabled>Request Type </option>
                                            <option value="new_upload">New Upload</option>
                                        </select>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                    <select class="f-control f-dropdown" name="master_tools" placeholder="Select your reading tool">
                                        <option value=""> </option>
                                        @foreach($masterTools as $ma)
                                            <option data-image="{{ get_dropdown_image(trim_str($ma)) }}" value="{{$ma}}">{{get_tools(trim_str($ma)).' (master)'}}</option>
                                        @endforeach
                                        @foreach($slaveTools as $s)
                                            <option data-image="{{ get_dropdown_image(trim_str($s)) }}" value="{{$s}}">{{get_tools(trim_str($s)).' (slave)'}}</option>
                                        @endforeach
                                      </select>
                                   
                                </div>
                                @error('master_tools')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                            </div>
                            <div class="file-field input-field col s12">
                                <div class="btn">
                                    <span><i class="fa fa-paperclip"></i></span>
                                    <input type="file" name="request_file" class="" id="request_file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" name="attachment" type="text" placeholder="File">
                                </div>
                                @error('request_file')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                            {{-- <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                    <input type="file" name="request_file" id="request_file">
                                </div>
                                @error('request_file')
                                <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                            </div> --}}
                        </div>
                        </div>
                        <div class="tab-footer text-center">
                            <button class="btn btn-red waves-effect waves-light submit-new-request" type="submit"><i class="fa fa-hand-o-right"></i>Next</button>
                        </div>
                    </form>
                </div>
            
                
                <div id="Paris" class="tabcontent timeline-actions z-depth-1">
                    <form method="POST" action="{{ route('file-engineers-notes') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                        <div class="tab-content">
                            @if ($message = Session::get('success'))
                                <div style="background: #28a745!important; padding: 10px;">
                                    <span style="margin:0; color:white;">{{ $message }}</span>
                                    <i class="fa fa-close close-message" style="float:right; margin-top:2px; color:white;"></i>
                                </div>
                            @endif
                        <label style="font-size: 16px;">Ask for engineer's support</label>
                        <div class="row mt-5">
                            <div class="input-field col s12">
                                <textarea id="car-info-memo" name="egnineers_internal_notes" class="materialize-textarea" placeholder="Internal note for Engineers."></textarea>
                                
                                <div class="file-field input-field col s12">
                                    <div class="btn">
                                        <span><i class="fa fa-paperclip"></i></span>
                                        <input type="file" name="engineers_attachement" class="" id="engineers_attachement">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" name="attachment" type="text" placeholder="File">
                                    </div>
                                    @error('engineers_attachement')
                                        <p class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                
                                {{-- <div class="select-wrapper form-control">
                                    <input type="file" name="engineers_attachement" id="engineer_attachement">
                                </div>
                                @error('engineers_attachement')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror --}}
                            </div>
                        </div>
                        </div>
                        <div class="tab-footer text-center">
                            <button class="btn btn-red waves-effect waves-light submit-new-request" type="submit"><i class="fa fa-hand-o-right"></i>Send</button>
                        </div>
                    </form>
                </div>
                
                <div id="Tokyo" class="tabcontent timeline-actions z-depth-1">
                    <form method="POST" action="{{ route('file-events-notes') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="file_id" value="{{$file->id}}">
                        <div class="tab-content">
                            @if ($message = Session::get('success'))
                                <div style="background: #28a745!important; padding: 10px;">
                                    <span style="margin:0; color:white;">{{ $message }}</span>
                                    <i class="fa fa-close close-message" style="float:right; margin-top:2px; color:white;"></i>
                                </div>
                            @endif
                        <p style="font-size: 16px;">Add internal note to vehicle's timeline</p>
                        <br>
                        <small class="blue-olsx-text"><i class="fa fa-warning"></i> You are the only one to see this information, engineers are not notified. This is not a support
                            request.
                        </small>
                        <div class="row mt-5">
                            <div class="input-field col s12">
                                <textarea id="events_internal_notes" name="events_internal_notes" class="materialize-textarea" placeholder="Internal note description."></textarea>
                                <div class="select-wrapper form-control">
                                    <input type="file" name="events_attachement" id="events_attachement">
                                </div>
                                @error('request_file')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>
                        </div>
                        <div class="tab-footer text-center">
                            <button class="btn btn-red waves-effect waves-light submit-new-request" type="submit"><i class="fa fa-hand-o-right"></i>Send</button>
                        </div>
                    </form>
                </div>
                
                <ul class="timeline-list">
                    @foreach($attachedFiles as $f)
                        {{-- @isset($f['request_file']) --}}
                            <li class="timeline-event" id="">
                                @isset($f['request_file'])
                                    <div class="timeline-icon alert-blue">
                                        <i class="fa fa-download"></i>
                                    </div>
                                @endisset
                                @isset($f['egnineers_internal_notes'])
                                    <div class="timeline-icon alert-blue">
                                        <i class="fa fa-user"></i>
                                    </div>
                                @endisset
                                @isset($f['events_internal_notes'])
                                    <div class="timeline-icon alert-blue">
                                        <i class="fa fa-user"></i>
                                    </div>
                                @endisset
                                <div class="timeline-content">
                                    <span class="push-bit">
                                        @isset($f['request_file'])
                                            File received
                                        @endisset
                                        @isset($f['egnineers_internal_notes'])
                                            Messge Sent
                                        @endisset

                                        @isset($f['events_internal_notes'])
                                            Messge Sent
                                        @endisset

                                        @isset($f['file_url'])
                                        Messge Sent
                                    @endisset
                                    </span>

                                    <ul class="actions-list">
                                    </ul>
                                    <small class="timeline-time-small">{{\Carbon\Carbon::parse($f['created_at'])->diffForHumans()}}</small>
                                                        <div class="divider"></div>
                                        @isset($f['request_file'])
                                            <span class="red-olsx-text">Filename :</span>
                                        @endisset
                                        <span>
                                            @isset($f['request_file'])
                                                {{ $f['request_file'] }}
                                            @endisset

                                            @isset($f['egnineers_internal_notes'])
                                                {{ $f['egnineers_internal_notes'] }}
                                            @endisset

                                            @isset($f['events_internal_notes'])
                                                {{ $f['events_internal_notes'] }}
                                            @endisset

                                            @isset($f['file_url'])
                                            {{ $f['file_url'] }}
                                        @endisset

                                        </span>
                                                            
                                            <div class="divider">
                                            </div>
                                            @isset($f['request_file'])
                                                <div class="tab" style="height: 70px;">
                                                    <button class="tablinks-smaller defaulti tablinks{{$f['id']}}" onclick="openCity1(event, 'London1', {{$f['id']}})"><i class="fa fa-smile-o" style="margin-right:10px;"></i>Results</button>
                                                    <button class="tablinks-smaller tablinks{{$f['id']}}" onclick="openCity1(event, 'Paris1', {{$f['id']}})"><i class="fa fa-file" style="margin-right:10px;"></i>Logs</button>
                                                </div>
                                                
                                                <!-- Tab content -->
                                                <div id="London1{{$f['id']}}" class="tabcontent{{$f['id']}}" style=" margin: 30px 0px;">
                                                    <ul class="feedback">
                                                        <li class="angry" data-type="angry" data-id="{{$file->id}}" data-file_id="{{$f['id']}}">
                                                            <div>
                                                                <svg class="eye left">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                                <svg class="eye right">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                                <svg class="mouth">
                                                                    <use xlink:href="#mouth">
                                                                </svg>
                                                            </div>
                                                        </li>
                                                        <li class="sad" data-type="sad" data-id="{{$file->id}}" data-file_id="{{$f['id']}}">
                                                            <div>
                                                                <svg class="eye left">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                                <svg class="eye right">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                                <svg class="mouth">
                                                                    <use xlink:href="#mouth">
                                                                </svg>
                                                            </div>
                                                        </li>
                                                        <li class="ok" data-type="ok" data-id="{{$file->id}}" data-file_id="{{$f['id']}}">
                                                            <div></div>
                                                        </li>
                                                        <li class="good active" data-type="good" data-id="{{$file->id}}" data-file_id="{{$f['id']}}">
                                                            <div>
                                                                <svg class="eye left">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                                <svg class="eye right">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                                <svg class="mouth">
                                                                    <use xlink:href="#mouth">
                                                                </svg>
                                                            </div>
                                                        </li>
                                                        <li class="happy" data-type="happy" data-id="{{$file->id}}" data-file_id="{{$f['id']}}">
                                                            <div>
                                                                <svg class="eye left">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                                <svg class="eye right">
                                                                    <use xlink:href="#eye">
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                            
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
                                                            <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
                                                        </symbol>
                                                        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
                                                            <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
                                                        </symbol>
                                                    </svg>
                                                    
                                                </div>
                                                
                                                <div id="Paris1{{$f['id']}}" class="tabcontent{{$f['id']}}" style=" margin: 30px 0px;">
                                                    <form method="POST" action="{{ route('file-url') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="file_id" value="{{$file->id}}">
                                                        <div class="tab-content">
                                                            @if ($message = Session::get('success'))
                                                                <div style="background: #28a745!important; padding: 10px;">
                                                                    <span style="margin:0; color:white;">{{ $message }}</span>
                                                                    <i class="fa fa-close close-message" style="float:right; margin-top:2px; color:white;"></i>
                                                                </div>
                                                            @endif
                                                        <p style="font-size: 16px;">Upload and watch the datalogs</p>
                                                        
                                                        
                                                        <div class="row mt-5">
                                                            <div class="input-field col s12">
                                                                <textarea id="file_url" name="file_url" class="materialize-textarea" placeholder="URL"></textarea>
                                                                <div class="select-wrapper form-control">
                                                                    <input type="file" name="file_url_attachment" id="file_url_attachment">
                                                                </div>
                                                                @error('file_url_attachment')
                                                                    <p class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="tab-footer text-center">
                                                            <button class="btn btn-red waves-effect waves-light submit-new-request" type="submit"><i class="fa fa-hand-o-right"></i>Add To The Timeline</button>
                                                        </div>
                                                    </form>
                                                </div>
                                              @endisset
                                    <div>
                                        
                                    </div>
                                    
                                </div>
                                {{-- @isset($f['egnineers_internal_notes'])
                                    egnineers_internal_notes
                                @endisset
                                @isset($f['events_internal_notes'])
                                    events_internal_notes
                                @endisset --}}
                            </li>
                        {{-- @endisset --}}
                    @endforeach
                </ul>
            </div>
            </div>
                <div class="col s12 m12 l4 offset-l1">

                    <div class="car-id">
                        <div class="table-id">
                            <table>
                                <tbody><tr>
                                    <td>
                                        <img src="https://www.shiftech.eu/media/manufacturers/5f98ae3c7c4f9f03b4033f72a4d20dd6.png" alt=" logo" class="logo-id">
                                    </td>
                                    <td>
                                    <span class="car-info">
                                        {{ $file->file_attached }}                                                    
                                    </span>
                                        <span class="car-name">
                                            218/318/518 CDI (3.0) 184hp 400Nm
                                        </span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>

                    </div>

                    <div class="vehicle-id">
                        <form action="{{route('edit-milage');}}" class="car-info-form" name="car-info" enctype="application/x-www-form-urlencoded" method="post" novalidate="novalidate">
                            <h3 class="id-info">Car information</h3>

                            @csrf
                            <input type="hidden" name="id" value="{{$file->id}}">

                            <p>VIN <span class="label">{{$file->vin_number}}</span></p>
                            <p>Gearbox
                                <span class="label">
                                    {{$file->gear_box}}
                                </span>
                            </p>
                            <p>Fuel
                                <span class="label">
                                    Diesel
                                </span>
                            </p>
                            <p>
                                Plate
                                <input type="text" name="license_plate" value="{{$file->license_plate}}" class="validate vehicle-id-input">
                            </p>
                            <p>
                                1st registration year
                                <input type="text" name="first_registration" value="{{$file->first_registration}}" class="validate vehicle-id-input" pattern="[0-9]{4}">
                            </p>
                            <p>
                                Mileage
                                <input type="text" name="kilometrage" value="{{$file->kilometrage}}" class="validate vehicle-id-input">
                            </p>

                                                            <div class="input-field ">
                                <textarea id="car-info-memo" name="vehicle_internal_notes" class="materialize-textarea" placeholder="Internal note related to the vehicle :">{{$file->vehicle_internal_notes}}</textarea>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-clear waves-effect waves-light btn-vehicle-id">
                                    Save <i class="fa fa-save"></i>
                                    <i class="fa fa-refresh fa-spin fa-fw loading-icon"></i>
                                    <i class="fa fa-check success-icon"></i>
                                    <i class="fa fa-times error-icon"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="vehicle-id">
                        <h3 class="id-info">Parts</h3>
                                                </div>
                                                <div class="vehicle-id">
                            <form action="{{route('add-customer-note');}}" class="customer-info-form" name="customer-info" enctype="application/x-www-form-urlencoded" method="post" novalidate="novalidate">
                                @csrf
                            <input type="hidden" name="id" value="{{$file->id}}">
                                <span class="id-info">Customer information</span>
                                <div class="input-field ">
                                    <i class="fa fa-user prefix" style="margin-top: 8px;"></i>
                                    <input id="icon_prefix" type="text" class="validate" required="" name="name" value="{{$file->name}}" placeholder="Customer name">
                                </div>
                                <div class="input-field">
                                    <i class="fa fa-phone prefix" style="margin-top: 8px;"></i>
                                    <input id="icon_telephone" type="tel" class="validate" name="phone" value="{{$file->phone}}" placeholder="Phone">
                                </div>
                                <div class="input-field">
                                    <i class="fa fa-envelope prefix" style="margin-top: 8px;"></i>
                                    <input id="icon_telephone" type="email" class="validate" name="email" value="{{$file->email}}" placeholder="Email">
                                </div>
                                <div class="input-field ">
                                    <textarea id="icon_prefix2" class="materialize-textarea" name="customer_internal_notes" placeholder="Internal note related to the customer :">{{$file->customer_internal_notes}}</textarea>
                                </div>
                                <div class="center">
                                    <button class="btn btn-clear waves-effect waves-light btn-vehicle-id" type="submit">
                                        Save <i class="fa fa-save"></i>
                                        <i class="fa fa-refresh fa-spin fa-fw loading-icon"></i>
                                        <i class="fa fa-check success-icon"></i>
                                        <i class="fa fa-times error-icon"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                <div class="btn-group">                  
                </div>
            </div>
        </div>
    </div>
    </seciton>
</main>
@endsection

@section('pagespecificscripts')
<script type="text/javascript">

(function( $ ){
  $.fn.mySelectDropdown = function(options) {    
    return this.each(function() {  
      var $this = $(this);
      
      $this.each(function () {
        var dropdown = $("<div />").addClass("f-dropdown selectDropdown");
        
        if($(this).is(':disabled')) 
          dropdown.addClass('disabled');

        $(this).wrap(dropdown);

        var label = $("<span />").append($("<span />")
          .text($(this).attr("placeholder"))).insertAfter($(this));
        var list = $("<ul />");

        $(this)
          .find("option")
          .each(function () {
            var image = $(this).data('image');
            if(image) {
              list.append($("<li />").append(
                $("<a />").attr('data-val',$(this).val())
                .html(
                  $("<span />").append($(this).text())
                ).append('<img src="'+image+'">')
              ));
            } else if($(this).val() != '') {
              list.append($("<li />").append(
                $("<a />").attr('data-val',$(this).val())
                .html(
                  $("<span />").append($(this).text())
                )
              ));
            }
          });

        list.insertAfter($(this));

        if ($(this).find("option:selected").length > 0 && $(this).find("option:selected").val() != '') {
          list.find('li a[data-val="' + $(this).find("option:selected").val() + '"]').parent().addClass("active");
          $(this).parent().addClass("filled");
          label.html(list.find("li.active a").html());
        }
      });

      if(!$(this).is(':disabled')) {
        $(this).parent().on("click", "ul li a", function (e) {
          e.preventDefault();
          var dropdown = $(this).parent().parent().parent();
          var active = $(this).parent().hasClass("active");
          var label = active
            ? $('<span />').text(dropdown.find("select").attr("placeholder"))
            : $(this).html();

          dropdown.find("option").prop("selected", false);
          dropdown.find("ul li").removeClass("active");

          dropdown.toggleClass("filled", !active);
          dropdown.children("span").html(label);

          if (!active) {
            dropdown
              .find('option[value="' + $(this).attr('data-val') + '"]')
              .prop("selected", true);
            $(this).parent().addClass("active");
          }

          dropdown.removeClass("open");
        });

        $this.parent().on("click", "> span", function (e) {
          var self = $(this).parent();
          self.toggleClass("open");
        });

        $(document).on("click touchstart", function (e) {
          var dropdown = $this.parent();
          if (dropdown !== e.target && !dropdown.has(e.target).length) {
            dropdown.removeClass("open");
          }
        });
      }
    });
  };
})( jQuery );

$('select.f-dropdown').mySelectDropdown();
// $('select.ecu_file_select').mySelectDropdown();
// $('select.gearbox_file_select').mySelectDropdown();

    $( document ).ready(function(event) {

        $('.feedback li').click(function(e){
            $('.feedback li').removeClass('active');
            $(this).addClass('active');
            let type = $(this).data('type');
            let id = $(this).data('id');
            let file_id = $(this).data('type');

            console.log('type:'+type)
            console.log('id:'+id)
            console.log('file_id:'+file_id)
        });

        $('.close-message').click(function() {
            $(this).parent().addClass('hide');
        });

        $(".scroll-animation").click(function() {
            console.log('scroll');
        $('html,body').animate({
            scrollTop: $("#content").offset().top},
            'slow');
    });

    $('.file_type').click(function(e){
        if ($(this).is(':checked')) {
            let file_type = $(this).val();

            if(file_type == 'ECU'){
                console.log($('#ecu_file_select').next().next());
                $('#ecu_file_select').next().next().css("display", "block");
                $('#gearbox_file_select').next().next().css("display", "none");
                // $('#ecu_file_select').removeClass('hide');
                // $('#gearbox_file_select').addClass('hide');
            }
            else if(file_type == 'TCU') {
                // $('#ecu_file_select').addClass('hide');
                // $('#gearbox_file_select').removeClass('hide');

                $('#gearbox_file_select').next().next().css("display", "block");
                $('#ecu_file_select').next().next().css("display", "none");
            }
        }
    });

    $("span.file_type_area").click(function() { 

            let file_type = $(this).data('type');
            if(file_type == 'ecu_file'){
                $('#ecu_file_select').removeClass('hide');
                $('#gearbox_file_select').addClass('hide');
            }
            else {
                $('#ecu_file_select').addClass('hide');
                $('#gearbox_file_select').removeClass('hide');
            }
                $('span.file_type_area').removeClass('bordered_div');
                $(this).addClass('bordered_div');
                console.log(file_type);
                $('#file_type').val(file_type);
        });

    });

function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";

    }
document.getElementById("defaultOpen").click();


function openCity1(evt, cityName, id) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent"+id);
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks"+id);
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName+id).style.display = "block";
  evt.currentTarget.className += " active";

    }

    var el = document.getElementsByClassName('defaulti');
        for (var i=0;i<el.length; i++) {
            el[i].click();
        }

</script>
@endsection