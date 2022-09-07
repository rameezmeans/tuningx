@extends('layouts.app')

@section('pagespecificstyles')
<style>
    /* Style the tab */
.tab {
  /* overflow: hidden; */
  
  color: #f02429;
  background-color: #fff;
    box-shadow: none;
    display: flex;
    font-size: 16px;
    height: 48px;
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
  width: 25%;
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
@include('layouts.nav')

<main>
    <div class="container">
        <h1>Account</h1>
        <div class="account section">
            <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Profile')" id="defaultOpen">Profile</button>
            <button class="tablinks" onclick="openCity(event, 'Contact')">Contact</button>
            <button class="tablinks" onclick="openCity(event, 'Tools')">Tools</button>
            <button class="tablinks" onclick="openCity(event, 'Workstation')">Workstation</button>
            <button class="tablinks" onclick="openCity(event, 'Password')">Password</button>
            <button class="tablinks" onclick="openCity(event, 'CreditLog')">Credit Log</button>
        </div>
  
        <!-- Tab content -->
        <div id="Profile" class="tabcontent">
            <h4 class="m-b-lg">Billing Information</h4>
            <label class="account-label">Status</label>
            <input type="text" readonly value="{{ ucfirst( Auth::user()->status) }}">

            <label class="account-label">Country</label>
            <input type="text" readonly value="{{ Auth::user()->country }}">

            <label class="account-label">Company Name</label>
            <input type="text" readonly value="{{ Auth::user()->company_name }}">

            <label class="account-label">Company trade register identification number</label>
            <input type="text" readonly value="{{ Auth::user()->company_id }}">

            <label class="account-label">Name:</label>
            <input type="text" readonly value="{{ Auth::user()->name }}">

            <label class="account-label">Address</label>
            <input type="text" readonly value="{{ Auth::user()->address }}">

            <label class="account-label">Zip Code</label>
            <input type="text" readonly value="{{ Auth::user()->zip }}">

            <label class="account-label">City</label>
            <input type="text" readonly value="{{ Auth::user()->city }}">

            <label class="account-label">Phone</label>
            <input type="text" readonly value="{{ Auth::user()->phone }}">
            
        </div>
        
        <div id="Contact" class="tabcontent">
            <h3>Paris</h3>
            <p>Paris is the capital of France.</p>
        </div>
        
        <div id="Tools" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div>
        <div id="Workstation" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div>
        <div id="Password" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div>
        <div id="CreditLog" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div>
        </div>
    </div>
</main>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">

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