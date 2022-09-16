@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1>File Upload</h1>
        <div class="file-service-process">
            <div class="process-panel">
                <div class="row">
                    @if($errors->any())
                        {{ implode('', $errors->all('message')) }}
                    @endif
                    <div class="col s12 master-tools">
                        <h2>Reading tool</h2>
                        <small><i class="fa fa-info-circle"></i> To edit reading tool list <a href="{{ route('account') }}" target="_blank">click here</a></small>
                    </div>
                    <div class="col s12 m-b-lg master-tools">
                        <div class="input-field tool-selection">
                            <h3>Master</h3>
                            <div id="file_upload_form_readingToolMaster">
                                @foreach($masterTools as $m)
                                    <input type="radio" id="{{'master_'.trim_str($m)}}" name="tool_selected" data-type='master' data-icon="https://www.shiftech.eu/media/olsx/tools/4ebbd61393fb57d18efc69471b790e06.png" value="{{trim_str($m)}}">
                                    <label class="tools hide" for="{{'master_'.trim_str($m)}}" style="background-image: url(&quot;https://www.shiftech.eu/media/olsx/tools/4ebbd61393fb57d18efc69471b790e06.png&quot;);">{{get_tools(trim_str($m))}}</label>
                                @endforeach 
                                
                            </div>
                        </div>
                    </div>
                
                    <div class="col s12 m-b-lg radios slave-tools">
                        <div class="input-field tool-selection">
                            <h3>Slave</h3>
                            <div id="file_upload_form_readingToolSlave">
                                @foreach ($slaveTools as $s)
                                    <input type="radio" id="{{'slave_'.trim_str($s)}}" name="tool_selected" data-type="slave" data-icon="https://www.shiftech.eu/media/olsx/tools/4283215581bc46c7f5a4687a35c45e31.png" value="{{trim_str($s)}}">
                                    <label class="tools hide" for="{{'slave_'.trim_str($s)}}" style="background-image: url(&quot;https://www.shiftech.eu/media/olsx/tools/4283215581bc46c7f5a4687a35c45e31.png&quot;);">{{get_tools(trim_str($s))}}</label>
                                @endforeach
                        </div>
                    </div>
                </div>
                

                <div id="upload-area" class="hide">
                    <form method="POST" action="{{ route('upload-file') }}" enctype="multipart/form-data" id="uploadfile" class="dropzone">
                        @csrf
                        <div>
                            <h5>Please Drop and file here by Click. (Zip or RAR are not allowed.)</h5>
                        </div>
                    </form>
                </div>
                <div ><h5 id="file-name" class="hide mt-5"></h5></div>
                <div id="posting-file" class="hide">
                    <form method="post" action="{{ route('post-file') }}">
                        <input type="hidden" name="tool" id="tool" value="">
                        <input type="hidden" name="tool_type" id="tool_type" value="">
                        <input type="hidden" name="file_attached" id="file_attached" value="">
                        <input type="hidden" name="file_type" id="file_type" value="">
                        @csrf

                        <div class="row mt-5">
                            <h3 style="margin-left:12px;">Customer Info</h3>
                            <div class="input-field col s12">
                                <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror" required="required" placeholder="Full Name ">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s6">
                                <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror" required="required" placeholder="Email ">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="phone" name="phone" class="@error('phone') is-invalid @enderror" required="required" placeholder="Phone ">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-5">

                            <h3 style="margin-left:12px;">Select File Type</h3>
                            <div class="input-field col s6" style="margin-left:5px; display:flex;">
                                <span class="file_type_area" style="padding: 20px;" data-type="ecu_file">
                                    <button class="btn" type="button"><i class="fa fa-home"></i></button>
                                    <p>ECU File</p>
                                </span>
                                <span style="margin-left: 10px; padding: 20px;" class="file_type_area" data-type="gearbox_file">
                                    <button class="btn" type="button"><i class="fa fa-home"></i></button>
                                    <p>Gearbox File</p>
                                </span>
                                @error('file_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                            <div class="row mt-5">

                            <h3 style="margin-left:12px;">Customer Vehicle Info</h3>
                            <div class="input-field col s6">
                                <input type="text" id="model_year" name="model_year" class="@error('model_year') is-invalid @enderror" required="required" placeholder="Model ">
                                @error('model_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s6">
                                <input type="text" id="license_plate" name="license_plate" class="@error('email') is-invalid @enderror" required="required" placeholder="License Plate ">
                                @error('license_plate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <input type="text" id="vin_number" name="vin_number" class="@error('vin_number') is-invalid @enderror" required="required" placeholder="Vin Number ">
                                @error('vin_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="brand" id="brand" class="select-dropdown">
                                    <option value="Brand" selected disabled>Brand</option>
                                    <option value="BMW">BMW</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="model" id="model" class="select-dropdown">
                                    <option value="model" selected disabled>Model</option>
                                    <option value="2018">2018</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="version" id="version" class="select-dropdown">
                                    <option value="version" selected disabled>Version</option>
                                    <option value="1234">1234</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="tools" id="tools" class="select-dropdown">
                                    <option value="tools" selected disabled>Tools</option>
                                    <option value="tools">Tools</option>
                                  </select>
                                </div>
                            </div>

                            <div class="input-field col s12">
                                <div class="select-wrapper form-control">
                                <select name="gear_box" id="gear_box" class="select-dropdown">
                                    <option value="gear_box" selected disabled>Gears Box</option>
                                    <option value="tools">Gears</option>
                                  </select>
                                </div>
                            </div>

                            </div>

                            <div class="row">
                                <div class="input-field col s12 center">
                                    <button type="submit" id="register_form_Register" class="waves-effect waves-light btn btn-red">Send File</button>
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

Dropzone.autoDiscover = false;
  
var dropzone = new Dropzone('#uploadfile', {
        thumbnailWidth: 200,
        maxFilesize: 10,
    //   acceptedFiles: "'',.cod,.bin",
        
        success: function(file, response) {
            console.log(response);
            $('#upload-area').addClass('hide');
            $('#file-name').html(response.success+' (File Attached)');
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

$( document ).ready(function(event) {

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
