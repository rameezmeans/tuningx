@extends('layouts.file_layout')

@section('pagespecificstyles')

<style>

.tab .tablinks .wow  i {
    display: block;
    font-size: 1.5em;
}

.tab .tablinks .wow  span {
    display: block;
}

.tab .tablinks .wow  small {
    display: block;
}

.tablinks {
    height: 100px;
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
                    <h3>London</h3>
                    <p>London is the capital city of England.</p>
                </div>
                
                <div id="Paris" class="tabcontent timeline-actions z-depth-1">
                    <h3>Paris</h3>
                    <p>Paris is the capital of France.</p>
                </div>
                
                <div id="Tokyo" class="tabcontent timeline-actions z-depth-1">
                    <h3>Tokyo</h3>
                    <p>Tokyo is the capital of Japan.</p>
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
    $( document ).ready(function(event) {
        $(".scroll-animation").click(function() {
            console.log('scroll');
        $('html,body').animate({
            scrollTop: $("#content").offset().top},
            'slow');
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


</script>
@endsection