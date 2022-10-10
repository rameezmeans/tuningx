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
            <div class="form-pad">
            <h4 class="m-b-lg">Billing Information</h4>
            <label class="account-label">Status</label>
            <input type="text" readonly value="{{ ucfirst( Auth::user()->status) }}">

            <label class="account-label">Country</label>
            <input type="text" readonly value="{{ code_to_country( Auth::user()->country) }}">

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
        </div>
        
        <div id="Contact" class="tabcontent">
            <div class="form-pad">
                <label class="account-label">Application Language</label>
                <input type="text" readonly value="{{ ucfirst( Auth::user()->language) }}">

                <label class="account-label">Email</label>
                <input type="text" readonly value="{{ Auth::user()->email }}">
            </div>

            <div class="form-pad">
                <h4 class="m-b-lg" style="display:inline-block;">Spoken Languages</h4>
                <button id="addLangBtn" class="btn btn-red waves-effect waves-light m-sm create-language right" data-toggle="modal" data-target="#modalCreateLanguage">Add language</button>
                <p class="red-olsx-text">Warning : languages you have selected means that you may receive messages in that language.</p>
                                                    
                @if(count($languages) == 0)
                                <div>No Language Added.</div>
                        @else   
                <table class="table"> 
                    <thead>
                        <tr>
                            <th data-type="html">Language</th>
                            <th data-type="html">Mastery</th>
                            <th data-type="html" data-filterable="false">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($languages as $language)
                                <tr>
                                    <td>{{$language->language}}</td>
                                    <td>{{$language->mastery}} <i class="fa fa-star"></i></td>
                                    <td>
                                        <a href="" data-id="1120" data-language="EL" data-mastery-level="5" class="btn-white tooltipped edit-language" data-position="bottom" data-tooltip="Edit language" data-tooltip-id="2d6946f8-2c10-751b-27a0-a6bcad59f55d">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="" data-id="1120" class="btn-white tooltipped delete-language" data-position="bottom" data-tooltip="Delete language" data-tooltip-id="0e15e089-5504-e3bb-1c34-e9c559cce630">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>  
                            @endforeach                                
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        
        <div id="Tools" class="tabcontent">
            <div class="form-pad">
                <h4 class="m-b-lg">Tools</h4>
            </div>
        </div>
        <div id="Workstation" class="tabcontent">
            <div class="form-pad">
                <h4 class="m-b-lg">Add Workstation</h4>
            </div>
        </div>
        <div id="Password" class="tabcontent">
            <form name="" method="post" action="{{ route('change-password') }}">
                @csrf
                <div class="form-pad">
                    <h4 class="m-b-lg">Change Password</h4>
                    <label class="account-label">Current Password</label>
                    <input type="password" name="current_password">

                    <label class="account-label">New Password</label>
                    <input type="password" name="new_password">

                    <label class="account-label">Confirm Password</label>
                    <input type="password" name="confirm_password">
                    <button type="reset" id="language_create_form_Cancel"  class="waves-effect waves-light btn modal-action modal-close">Cancel</button>
                    <button type="submit" id="language_create_form_Save"  class="btn btn-red waves-effect waves-light m-sm">Confirm</button>
                </div>
            </form>
        </div>
        <div id="CreditLog" class="tabcontent">
            <div class="form-pad">
                <h4 class="m-b-lg">Credit Logs</h4>
            </div>
        </div>
        </div>
    </div>
</main>
<div id="modalCreateLanguage" class="modal" style="z-index: 1011;opacity: 1; transform: scaleX(1); top: 10%;">
    <div class="modal-content">
        <form name="" method="post" action="{{ route('create-language') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <h4 id="modalAddTitle">Add language</h4>
        
        <div>
            <label for="mastery_level">Language :</label>
            <div class="input-field col s12">
                <div class="select-wrapper form-control">
                <select name="language" id="language" class="select-dropdown">
                    <option value="English">English</option>
                    <option value="French">French</option>
                  </select>
                </div>
            </div>
            <label for="mastery_level">Mastery :</label>
            <div class="level-container">
                <input type="hidden" id="language_create_form_masteryLevel" name="mastery" value="4">
                <i class="fa level-star star-nb-1 fa-star" data-level="1"></i>
                <i class="fa level-star star-nb-2 fa-star" data-level="2"></i>
                <i class="fa level-star star-nb-3 fa-star" data-level="3"></i>
                <i class="fa level-star star-nb-4 fa-star-o" data-level="4"></i>
                <i class="fa level-star star-nb-5 fa-star-o" data-level="5"></i>
            </div>
        </div>
        <button type="reset" id="language_create_form_Cancel"  class="waves-effect waves-light btn modal-action modal-close" data-dismiss="modal" aria-label="Close">Cancel</button>
        <button type="submit" id="language_create_form_Save"  class="btn btn-red waves-effect waves-light m-sm">Confirm</button>
    </div>
</div>
<div class="modal-overlay" style="z-index: 1010; opacity: 0.5;"></div>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">

$( document ).ready(function(event) {
    $(document).on('click','#addLangBtn', function(e){
        // e.preventdefault;
       console.log('btn clicked');
       $('.modal-overlay').css({display: "block"});
   });

   $('.level-star').click(function(e){
        // e.preventdefault;
        let level = $(this).data('level');
        $('.level-star').removeClass('fa-star-o');
        $('.level-star').removeClass('fa-star');
        $('.level-star').each(function(i, obj) {
            let inner_level = $(obj).data('level');
            if( inner_level <= level ){
                $(this).addClass('fa-star');
            }
            else {
                $(this).addClass('fa-star-o');
            }
        });

        $('#language_create_form_masteryLevel').val(level);
       
      
   });

   $(document).on('click','#language_create_form_Cancel', function(e){
    if($('.modal-overlay').css('display') == 'block'){
        console.log('closed');
        $('.modal-overlay').css("display", "none");
     }
   });

//    $('body').click(function (event) 
// {
//    if(!$(event.target).closest('#modalCreateLanguage').length && !$(event.target).is('#modalCreateLanguage')) {
//      $("#modalCreateLanguage").hide();
//      if($('.modal-overlay').css('display') == 'block'){
//         // $('.modal-overlay').css("display", "none");
//      }
//    }     
// });

// $('#addLangBtn').click(function(e){
//         e.preventdefault;
//        console.log('btn clicked');
//        $('.modal-overlay').css({display: "block"});
//    });


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