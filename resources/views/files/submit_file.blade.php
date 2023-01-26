@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1>{{__('File Upload')}}</h1>
        <div class="file-service-process">
            <div class="process-panel">
                <div class="row">
                    @if($errors->any())
                    <p class="danger">{{ implode('', $errors->all(':message')) }}</p>
                    @endif
                    <div class="col s12 master-tools  @if($errors->any()) hide @endif">
                        <h2>{{__('Reading tool')}}</h2>
                        <small><i class="fa fa-info-circle"></i> To edit reading tool list <a href="{{ route('account', ['tab' => 'tools']) }}" target="_blank">click here</a></small>
                    </div>
                    <div class="col s12 m-b-lg master-tools @if($errors->any()) hide @endif">
                        @if(!empty($masterTools))
                        <div class="input-field tool-selection">
                            <h3>Master</h3>
                            <div id="file_upload_form_readingToolMaster">
                                @foreach($masterTools as $m)
                                <input type="radio" id="{{'master_'.trim_str($m)}}" name="tool_selected" data-type='master' value="{{trim_str($m)}}">
                                <label class="tools hide" for="{{'master_'.trim_str($m)}}" style="background-image: url(&quot;{{ get_dropdown_image(trim_str($m)) }}&quot;);">{{get_tools(trim_str($m))}}</label>
                                @endforeach

                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col s12 m-b-lg radios slave-tools @if($errors->any()) hide @endif">
                        @if(!empty($slaveTools))
                        <div class="input-field tool-selection">
                            <h3>Slave</h3>
                            <div id="file_upload_form_readingToolSlave">
                                @foreach ($slaveTools as $s)
                                <input type="radio" id="{{'slave_'.trim_str($s)}}" name="tool_selected" data-type="slave" value="{{trim_str($s)}}">
                                <label class="tools hide" for="{{'slave_'.trim_str($s)}}" style="background-image: url(&quot;{{ get_dropdown_image(trim_str($s)) }}&quot;);">{{get_tools(trim_str($s))}}</label>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>


                    <div id="upload-area" class="hide">
                        <form method="POST" action="{{ route('upload-file') }}" enctype="multipart/form-data" id="uploadfile" class="dropzone">
                            @csrf
                            <div>
                                <h5>{{__('Please Drop and file here by Click. (Zip or RAR are not allowed.)')}}</h5>
                            </div>
                        </form>
                    </div>
                    <div>
                        <h5 id="file-name" class="@if($errors->any()) show @else hide @endif mt-5">{{ old('file_attached').' (file attached)' }}</h5>
                    </div>
                    <div id="posting-file" class="@if($errors->any()) show @else hide @endif">
                        <form method="POST" action="{{ route('post-file') }}">
                            <input type="hidden" name="tool" id="tool" value="{{ old('tool') }}">
                            <input type="hidden" name="tool_type" id="tool_type" value="{{ old('tool_type') }}">
                            <input type="hidden" name="file_attached" id="file_attached" value="{{ old('file_attached') }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            {{-- <input type="hidden" name="file_type" id="file_type" value="{{ old('file_type') }}"> --}}
                            @csrf

                            <div class="row mt-5">
                                <h3 style="margin-left:12px;">{{__('Customer Info')}}</h3>
                                <div class="input-field col s12">
                                    <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror" required="required" placeholder="{{__('Full Name')}} " value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror" required="required" placeholder="{{__('Email')}} " value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" id="phone" name="phone" class="@error('phone') is-invalid @enderror" required="required" placeholder="{{__('Phone')}} " value="{{ old('phone') }}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-5">

                                <h3 style="margin-left:12px;">{{__('Select File Type')}}</h3>
                                {{-- <div class="input-field col s12" style="margin-left:5px; display:flex;"> --}}
                                <div class="col s12 m4 file-type-buttons">
                                    <label class="file-type-label col s6">
                                        <input type="radio" value="ecu_file" class="file-selection file_type_area" name="file_type" data-type="ecu_file">
                                        <img src="https://resellers.ecutech.tech/assets/img/OLSx-pictogram-file-02.svg">
                                        <span>
                                            ECU file
                                        </span>
                                    </label>
                                    <label class="file-type-label col s6">
                                        <input type="radio" value="gearbox_file" class="file-selection file_type_area" name="file_type" data-type="gearbox_file">
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
                                {{-- <div class="input-field col s6" style="margin-left:5px; display:flex;">
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

                    </div>

                    <div class="row mt-5">

                        <h3 style="margin-left:12px;">{{__('Customer Vehicle Info')}}</h3>
                        <div class="input-field col s6">
                            <input type="text" id="model_year" name="model_year" class="@error('model_year') is-invalid @enderror" required="required" placeholder="{{__('Model Year')}} " value="{{ old('model_year') }}">
                            @error('model_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-field col s6">
                            <input type="text" id="license_plate" name="license_plate" class="@error('email') is-invalid @enderror" required="required" placeholder="{{__('License Plate')}} " value="{{ old('model_year') }}">
                            @error('license_plate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <input type="text" id="vin_number" name="vin_number" class="@error('vin_number') is-invalid @enderror" required="required" placeholder="{{__('Vin Number')}} " value="{{ old('model_year') }}">
                            @error('vin_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-field col s12">
                            <div class="select-wrapper form-control">
                                <select name="brand" id="brand" class="select-dropdown">
                                    @if(!old('brand'))
                                    <option selected value="brand">{{__('Brand')}}</option>
                                    @endif
                                    @foreach ($brands as $b)
                                    <option @if(old('brand')==$b) selected @endif value="{{ $b }}">{{$b}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <div class="select-wrapper form-control">
                                <select name="model" id="model" class="select-dropdown" disabled>
                                    <option value="model" @if(!old('model')) selected @endif disabled>{{__('Model')}}</option>

                                </select>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <div class="select-wrapper form-control">
                                <select name="version" id="version" class="select-dropdown" disabled>
                                    <option value="version" @if(!old('version')) selected @endif disabled>{{__('Version')}}</option>

                                </select>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <div class="select-wrapper form-control">
                                <select name="engine" id="engine" class="select-dropdown" disabled>
                                    <option value="engine" @if(!old('engine')) selected @endif disabled>{{__('Engine')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <div class="select-wrapper form-control">
                                <select name="ecu" id="ecu" class="select-dropdown" disabled>
                                    <option value="ecu" @if(!old('ecu')) selected @endif disabled>ECU</option>

                                </select>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <div class="select-wrapper form-control">
                                <select name="gear_box" class="select-dropdown">
                                    <option value="gear_box" @if(!old('gear_box')) selected @endif disabled>Gears Box</option>
                                    <option value="auto_gear_box" @if(!old('gear_box')) @endif>{{__('Automatic Gears Box')}}</option>
                                    <option value="manual_gear_box" @if(!old('gear_box')) selected @endif>{{__('Manual Gears Box')}}</option>

                                </select>
                            </div>
                        </div>
                        
                        <span style="margin-bottom: 0px !important; margin-left: 12px;
                        margin-top: 16px; ">{{__('Additional Comments for Engineer')}}</span>
                        <div class="input-field col s12" style="margin-top: 0.5rem !important;">
                            <div class="select-wrapper form-control">
                                <textarea type="text" id="additional_comments" name="additional_comments" class="materialize-textarea @error('additional_comments') is-invalid @enderror" placeholder="{{__('Additional Comments')}} ">{{ old('additional_comments') }}</textarea>
                                @error('additional_comments')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <h2>{{__('General terms and conditions')}} </h2>
                            </div>
                            <div class="col s12">
                                <p>
                                    <input type="checkbox" class="cgv-checkbox" id="cgv">
                                    <label for="cgv">

                                        {{__('I understand and agree to')}} <a class="modal-trigger" href="#modal" style="z-index: 1003;"><strong>{{__('the terms and conditions of sales')}}</strong></a>
                                    </label>
                                </p>
                                <p>
                                    <input type="checkbox" class="cgv-checkbox" id="professional">
                                    <label for="professional">
                                        {{__('Hereby, I declare that I am a professional')}}
                                    </label>
                                </p>
                                <p>
                                    <input type="checkbox" class="cgv-checkbox" id="track">
                                    <label for="track">
                                        {{__('I acknowledge that I am fully aware that the tuned software are dedicated to vehicles intended exclusively for use on race track')}}

                                    </label>
                                </p>
                                <p id="create_vehicle_form_checkbox-error-custom" class="input-field" style="display: none;">
                                    <span class="invalid">{{__('You must accept the different conditions above to be able to submit your request.')}}</span>
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="input-field col s12 center">
                            <button type="submit" id="register_form_Register" class="waves-effect waves-light btn btn-red" disabled>{{__('Next')}}</button>
                        </div>
                    </div>

                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">
    var boxcounter;
    $(function() {
        let boxcounter = 0;
        $(".cgv-checkbox").click(function() {
            if (this.checked) {
                console.log('checked');
                boxcounter++;
                if (boxcounter == 3) {
                    $("#register_form_Register").removeAttr("disabled");
                }
            } else {
                boxcounter--;
                if (boxcounter < 3) {
                    $("#register_form_Register").attr("disabled", "disabled");
                }
            }
        });
    });

    function disable_dropdowns() {

        $('#model').children().remove();
        $('#model').append('<option selected id="model">Model</option>');
        $('#version').children().remove();
        $('#version').append('<option selected id="version">Version</option>');
        $('#ecu').children().remove();
        $('#ecu').append('<option selected id="ecu">ECU</option>');
        $('#gear_box').children().remove();

        $('#model').attr('disabled', 'disabled');
        $('#version').attr('disabled', 'disabled');
        $('#ecu').attr('disabled', 'disabled');
        $('#gear_box').attr('disabled', 'disabled');
    }

    Dropzone.autoDiscover = false;

    var dropzone = new Dropzone('#uploadfile', {
        thumbnailWidth: 200,
        maxFilesize: 10,
        //   acceptedFiles: "'',.cod,.bin",

        success: function(file, response) {
            console.log(response);
            $('#upload-area').addClass('hide');
            $('#file-name').html('(File Attached)');
            $('#file_attached').val(response.success);
            $('#file-name').removeClass('hide');
            $('#posting-file').removeClass('hide');
            $('.master-tools').addClass('hide');
            $('.slave-tools').addClass('hide');
        },
        error: function(file) {
            // code here..
        }
    });

    $(document).ready(function(event) {

        $(document).on('change', '#brand', function(e) {
            let brand = $(this).val();
            disable_dropdowns();

            $.ajax({
                url: "/get_models",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'brand': brand
                },
                success: function(items) {
                    console.log(items);

                    $('#model').removeAttr('disabled');
                    $('#version').attr('disabled', 'disabled');
                    $('#tools').attr('disabled', 'disabled');
                    $('#gear_box').attr('disabled', 'disabled');

                    $.each(items.models, function(i, item) {
                        console.log(item.model);
                        $('#model').append($('<option>', {
                            value: item.model,
                            text: item.model
                        }));
                    });
                }
            });
        });

        $(document).on('change', '#model', function(e) {
            // disable_dropdowns();

            $('#version').children().remove();
            $('#version').append('<option selected id="version">Version</option>');
            $('#ecu').children().remove();
            $('#ecu').append('<option selected id="ecu">ECU</option>');
            $('#gear_box').children().remove();

            $('#version').attr('disabled', 'disabled');
            $('#ecu').attr('disabled', 'disabled');
            $('#gear_box').attr('disabled', 'disabled');

            let model = $(this).val();
            let brand = $('#brand').val();
            $.ajax({
                url: "/get_versions",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'model': model,
                    'brand': brand
                },
                success: function(items) {
                    console.log(items);
                    $('#model').removeAttr('disabled');
                    $('#version').removeAttr('disabled');
                    $('#tools').attr('disabled', 'disabled');
                    $('#gear_box').attr('disabled', 'disabled');
                    $.each(items.versions, function(i, item) {
                        console.log(item.generation);
                        $('#version').append($('<option>', {
                            value: item.generation,
                            text: item.generation
                        }));
                    });

                }
            });
        });

        $(document).on('change', '#version', function(e) {
            // disable_dropdowns();
            $('#engine').children().remove();
            $('#engine').append('<option selected value"engine" disabled>Engine</option>');


            // $('#model').attr('disabled', 'disabled');
            // $('#version').attr('disabled', 'disabled');
            $('#engine').attr('disabled', 'disabled');


            let version = $(this).val();
            let brand = $('#brand').val();
            let model = $('#model').val();

            $.ajax({
                url: "/get_engines",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'model': model,
                    'brand': brand,
                    'version': version,
                },
                success: function(items) {
                    $('#engine').removeAttr('disabled');

                    console.log(items.engines);

                    $.each(items.engines, function(i, item) {
                        $('#engine').append($('<option>', {
                            value: item.engine,
                            text: item.engine
                        }));
                    });
                }
            });
        });

        $(document).on('change', '#engine', function(e) {
            // disable_dropdowns();
            $('#ecu').children().remove();
            $('#ecu').append('<option selected value="ecu" disabled>ECU</option>');
            // $('#model').attr('disabled', 'disabled');
            // $('#version').attr('disabled', 'disabled');
            $('#ecu').attr('disabled', 'disabled');
            let engine = $(this).val();
            let brand = $('#brand').val();
            let model = $('#model').val();
            let version = $('#version').val();

            $.ajax({
                url: "/get_ecus",
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'model': model,
                    'brand': brand,
                    'version': version,
                    'engine': engine,
                },
                success: function(items) {
                    console.log(items);
                    $('#ecu').removeAttr('disabled');
                    $('#gear_box').removeAttr('disabled');
                    $.each(items.ecus, function(i, item) {
                        $('#ecu').append($('<option>', {
                            value: item,
                            text: item
                        }));
                    });
                }
            });
        });

        $("span.file_type_area").click(function() {

            let file_type = $(this).data('type');
            $('span.file_type_area').removeClass('bordered_div');
            $(this).addClass('bordered_div');
            console.log(file_type);
            $('#file_type').val(file_type);
        });

        $(".tools").removeClass('hide');

        $("label.tools").click(function() {

            console.log($(this).prev().data('type'));
            console.log($(this).prev().val());
            $('#tool_type').val($(this).prev().data('type'));
            $('#tool').val($(this).prev().val());
            $('#upload-area').removeClass('hide');

        });

    });

</script>

@endsection
