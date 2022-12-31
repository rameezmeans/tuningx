@extends('layouts.front')


@section('pagespecificstyles')

<style>

/* .select2-container--default.select2-container--focus .select2-selection--multiple {
    border: 0 !important;
}

.select2-container--default .select2-selection--multiple {
    border: 0 !important;
}

.select2-search__field {
    background: #fff !important;
    border: 1px solid transparent !important;
    border-radius: 6px !important;
    box-shadow: 0 8px 20px 0 rgb(73 76 83 / 20%) !important;
    padding-left: 1em !important;
    padding-right: 1em !important;

    cursor: pointer;
    display: block;
    font-size: 1rem;
    height: 3rem;
    line-height: 3rem;
    margin: 0 0 15px;
    outline: none;
    padding: 0;
    position: relative;
    width: 100%;
} */

.select2-search__field {
    height: 1.8rem !important;
}

</style>

@endsection

@section('content')


        <div class="row m-n">
            <div id="login" class="col s12 m8 l6 offset-m2 offset-l3">
                <div class="watermark-back-middle-panel-thumb">
                                            <img src="https://resellers.ecutech.tech/assets/img/ecutech/logo_dark.png" class="responsive-img vehicle-watermark-back-wm">
                                    </div>
                                                                    <div id="login" class="register-panel">
                
                                                                        <div class="form-body">
                    <div class="center">
                        <h1 style="font-family: Roboto, sans-serif;">{{__('Register')}}</h1>
                        <span>{{__('To enjoy high quality tuning files through a user-friendly, intuitive web interface.')}}</span>
                    </div>
                    
                    @if($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="login-form">
                        @csrf

                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror" required="required" placeholder="{{__('Full Name')}} *">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="phone" name="phone" class="@error('phone') is-invalid @enderror" required="required" placeholder="{{__('Phone')}} *">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror" required="required" placeholder="{{__('Email')}} *">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror" required="required" placeholder="{{__('Password')}} *">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="password" id="password-confirm" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror" required="required" placeholder="{{__('Password Verification')}} *">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="language" id="language" class="select-dropdown">
                                    <option value="english">English</option>
                                    <option value="gr">Greek</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s9">
                                <input type="text" id="address" name="address" class="@error('address') is-invalid @enderror" required="required" placeholder="{{__('Address')}} *">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="text" id="zip" name="zip" class="@error('zip') is-invalid @enderror" required="required" placeholder="{{__('Zip')}} *">
                                @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <input type="text" id="city" name="city" class="@error('city') is-invalid @enderror" required="required" placeholder="{{__('City')}} *">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="country" id="country" class="select-dropdown">
                                    <option selected disabled>{{__('Select Your Country')}} *</option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AX">Aland Islands</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia</option>
                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvet Island</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CD">Congo, Democratic Republic of the Congo</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Cote D'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curacao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="TF">French Southern Territories</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard Island and Mcdonald Islands</option>
                                    <option value="VA">Holy See (Vatican City State)</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran, Islamic Republic of</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                    <option value="KR">Korea, Republic of</option>
                                    <option value="XK">Kosovo</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Lao People's Democratic Republic</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libyan Arab Jamahiriya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macao</option>
                                    <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia, Federated States of</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="AN">Netherlands Antilles</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestinian Territory, Occupied</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PN">Pitcairn</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RE">Reunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="BL">Saint Barthelemy</option>
                                    <option value="SH">Saint Helena</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="MF">Saint Martin</option>
                                    <option value="PM">Saint Pierre and Miquelon</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="CS">Serbia and Montenegro</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan, Province of China</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UM">United States Minor Outlying Islands</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VE">Venezuela</option>
                                    <option value="VN">Viet Nam</option>
                                    <option value="VG">Virgin Islands, British</option>
                                    <option value="VI">Virgin Islands, U.s.</option>
                                    <option value="WF">Wallis and Futuna</option>
                                    <option value="EH">Western Sahara</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="status" id="status" class="select-dropdown">
                                    <option value="status" selected disabled>{{__('Select Your Status')}} *</option>
                                    <option value="company">Company</option>
                                    <option value="private">Private</option>
                                    <option value="entrepreneur_microentreprise">Auto Entrepreneur / Microentreprise</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" id="company_name" name="company_name" class="@error('company_name') is-invalid @enderror" required="required" placeholder="{{__('Legal Name of the Company')}} *">
                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s12">
                                <input type="text" id="company_id" name="company_id" class="@error('company_id') is-invalid @enderror" required="required" placeholder="{{__('Company trade registration identification number')}}">
                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s12">
                                <input type="checkbox" id="slave_tools_flag" name="slave_tools_flag" value="slave_tools_flag">
                                <label for="slave_tools_flag"> {{__('I have slave tools.')}}</label><br>
                                <p style="margin-left:0.6rem;font-size:12px;">{{__('Please select at least one reading tool.')}}</p>
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="master_tools[]" id="master_tools" class="select-dropdown-multi" multiple>

                                    @foreach($masterTools as $tool)
                                        <option value="{{$tool->label}}">{{$tool->name}}</option>
                                    @endforeach
                                    
                                    {{-- <option value="Abrites">Abrites</option>
                                    <option value="Autotuner">Autotuner</option>
                                    <option value="Bflash">Bflash</option>
                                    <option value="BitBox">BitBox</option>
                                    <option value="Bytehooter">Bytehooter</option>
                                    <option value="CMD">CMD</option>
                                    <option value="Dataman">Dataman (eprom reader)</option>
                                    <option value="Dimsport_New_Genius">Dimsport New Genius</option>
                                    <option value="Dimsport_Trasdata">Dimsport Trasdata</option>
                                    <option value="ECUx">ECUx</option>
                                    <option value="Femto">Femto</option>
                                    <option value="Flex">Flex (magic)</option>
                                    <option value="Galetto">Galetto</option>
                                    <option value="HPturners">HPturners</option>
                                    <option value="IO_Terminal">I/O Terminal</option>
                                    <option value="K_tag">K-tag</option>
                                    <option value="Kess_V2">Kess V2</option>
                                    <option value="Kess_V3">Kess V3</option>
                                    <option value="Magic_MAGPro2">Magic MAGPro2</option>
                                    <option value="MHD">MHD</option>
                                    <option value="MMC_flasher">MMC flasher</option>
                                    <option value="MPPS">MPPS</option>
                                    <option value="PCM_Flash">PCM Flash</option>
                                    <option value="Powergate">Powergate</option>
                                    <option value="Tactrix">Tactrix</option>
                                    <option value="TGflash">TGflash</option> --}}
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select disabled name="slave_tools[]" id="slave_tools" class="select-dropdown-multi" multiple>
                                    @foreach($slaveTools as $tool)
                                        <option value="{{$tool->label}}">{{$tool->name}}</option>
                                    @endforeach
                                    {{-- <option value="Autotuner">Autotuner</option>
                                    <option value="Bflash">Bflash</option>
                                    <option value="CMD">CMD</option>
                                    <option value="EVC_BDM100">EVC BDM100</option>
                                    <option value="Flex">Flex (magic)</option>
                                    <option value="K_tag">K-tag</option>
                                    <option value="Kess_V2">Kess V2</option>
                                    <option value="Kess_V3">Kess V3</option> --}}
                                  </select>
                                </div>
                            </div>
                        </div>



                        {{-- <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="input-field col s12 center">
                                <button type="submit" id="register_form_Register" name="register_form[Register]" class="waves-effect waves-light btn btn-red">{{__('Register')}}</button>
                            </div>
                        </div>

                    </form>
                </div>
                
            </div>
            <div class="row">
                <div class="col s12 center m-t-lg">
                    <a class="btn waves-effect waves-light btn-grey" href="/login">{{__('Already registered')}} ? {{__('Login')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagespecificscripts')
<script type="text/javascript">
    $( document ).ready(function() {

        $(".select-dropdown-multi").select2({
			closeOnSelect : false,
			placeholder : "{{__('Select Tools')}}",
			// allowHtml: true,
			allowClear: true,
			tags: true // создает новые опции на лету
		});

        $('#slave_tools_flag').click(function() {
            if ($(this).is(':checked')) {
                console.log('checked');
                $("#slave_tools").removeAttr('disabled');
            }
            else {
                console.log('unchecked'); 
                $("#slave_tools").attr("disabled", "disabled");
            }
        });
    });
</script>
@endsection
