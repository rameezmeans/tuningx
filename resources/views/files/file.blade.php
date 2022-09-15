@extends('layouts.file_layout')
@section('content')
<main>
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
                    <div class="timeline block-content-full">
                        <div class="timeline-actions z-depth-1">
                            <ul class="tabs">
                                <li class="tab">
                                    <a href="#request-file" class="wow pulse active animated" data-wow-iteration="infinite" data-wow-delay="2s" data-wow-duration="3s" style="visibility: visible; animation-duration: 3s; animation-delay: 2s; animation-iteration-count: infinite;">
                                        <i class="mdi mdi-action-backup"></i>
                                        <span>
                                            New request
                                        </span>
                                        <small>Upload new read file</small>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a href="#helpDesk">
                                        <i class="mdi-hardware-headset-mic"></i>
                                        <span>
                                            Help
                                        </span>
                                        <small>Get in touch with the engineer</small>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a href="#add-event">
                                        <i class="mdi mdi-notification-event-note"></i>
                                        <span>
                                            Internal event
                                        </span>
                                        <small>Add new internal event</small>
                                    </a>
                                </li>
                            <li class="indicator" style="right: 601px; left: -8px;"></li></ul>
                        <div class="row">
                            <div id="helpDesk" class="col s12" style="display: none;"><div id="add-comment">
<form action="/en/client/file-history/MTI1MDkxOjE2NjMyMzgwNjk/save-comments/125091" method="post" enctype="multipart/form-data" name="file-comments">
    <div class="tab-content">
        <div class="row m-n">
            <div class="col s12">
                <p>Ask for engineer's support</p>
            </div>
            <div class="input-field col s12">
                <textarea id="file-comments-comments" required="" name="file-comments[comments]" class="materialize-textarea" placeholder="Message to the engineers"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span><i class="mdi-editor-attach-file"></i></span>
                    <input type="file" name="file" id="file-comments-attachment">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path" name="file-comments[attachment]" type="text" placeholder="Optional attachment">
                </div>
            </div>
        </div>
    </div>
    <div class="tab-footer">
        <div class="row">
            <div class="col s12 m12 center-align">
                <button class="btn btn-red waves-effect waves-light"><i class="mdi-content-send right" disabled="disabled"></i>Send</button>
            </div>
        </div>
    </div>
</form>
</div>
</div>
                                <div id="request-file" data-id="newRequest" class="col s12 operation active" data-path="new request">
                                                                            <form name="new_request" method="post" action="/en/client/file-history/MTI1MDkxOjE2NjMyMzgwNjk/new-request" enctype="multipart/form-data" novalidate="novalidate">
                                    <div class="tab-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <p>Send a new file request</p>
                                            </div>
                                            <div class="col s12 m4 file-type-buttons">
                                                                                                        <label class="file-type-label col s6">
                                                        <input type="radio" value="ECU" class="file-selection" name="new_request[file_type]" required="required">
                                                        <img src="/assets/img/OLSx-pictogram-file-02.svg">
                                                        <span>
                                                            ECU file
                                                        </span>
                                                    </label>
                                                                                                        <label class="file-type-label col s6">
                                                        <input type="radio" value="TCU" class="file-selection" name="new_request[file_type]" required="required">
                                                        <img src="/assets/img/OLSxGearBox.svg">
                                                        <span>
                                                            Gearbox file
                                                        </span>
                                                    </label>
                                                                                                </div>
                                                                                                                                                    <div class="input-field col s12 m8" onclick="event.stopPropagation();" style="display: none;">
                                                    <div class="select-wrapper validate"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-6f764024-27b4-539a-9f5c-40ef0111fab9" value="Request Type"><ul id="select-options-6f764024-27b4-539a-9f5c-40ef0111fab9" class="dropdown-content select-dropdown "><li class="disabled "><span>Request Type</span></li><li class=""><img alt="" src="http://resellers.ecutech.tech/assets/img/change_prepared.svg" class="left"><span>New upload</span></li><li class=""><img alt="" src="http://resellers.ecutech.tech/assets/img/change_prepared.svg" class="left"><span>Tuning evolution - I want to make a new tuning request.</span></li><li class=""><img alt="" src="http://resellers.ecutech.tech/assets/img/icons/rma_tune.svg" class="left"><span>Back to tuned - The car has been updated by the dealer, please renew the tuning.</span></li><li class=""><img alt="" src="http://resellers.ecutech.tech/assets/img/icons/rma_origin.svg" class="left"><span>Back to stock - Send me back the original version.</span></li><li class=""><img alt="" src="http://resellers.ecutech.tech/assets/img/icons/rma_ori_vr.svg" class="left"><span>Back to stock with virtual read - It's a virtual read, can you send me this file back to flash the car in stock mode?</span></li><li class=""><img alt="" src="http://resellers.ecutech.tech/assets/img/icons/rma_problem.svg" class="left"><span>Problem - RMA - I've an issue with this file, can you check?</span></li></ul><select name="new_request[request_type_ECU]" class="validate initialized" data-select-id="6f764024-27b4-539a-9f5c-40ef0111fab9">
                                                        <option value="" disabled="" selected="">Request Type</option>
                                                                                                                                                                                            <option value="new" data-icon="http://resellers.ecutech.tech/assets/img/change_prepared.svg" class="left">New upload</option>
                                                                                                                                                                                                                                                            <option value="stage_evo" data-icon="http://resellers.ecutech.tech/assets/img/change_prepared.svg" class="left">Tuning evolution - I want to make a new tuning request.</option>
                                                                                                                                                                                                                                                            <option value="rma_tune" data-icon="http://resellers.ecutech.tech/assets/img/icons/rma_tune.svg" class="left">Back to tuned - The car has been updated by the dealer, please renew the tuning.</option>
                                                                                                                                                                                                                                                            <option value="rma_origin" data-icon="http://resellers.ecutech.tech/assets/img/icons/rma_origin.svg" class="left">Back to stock - Send me back the original version.</option>
                                                                                                                                                                                                                                                            <option value="rma_ori_vr" data-icon="http://resellers.ecutech.tech/assets/img/icons/rma_ori_vr.svg" class="left">Back to stock with virtual read - It's a virtual read, can you send me this file back to flash the car in stock mode?</option>
                                                                                                                                                                                                                                                            <option value="rma_problem" data-icon="http://resellers.ecutech.tech/assets/img/icons/rma_problem.svg" class="left">Problem - RMA - I've an issue with this file, can you check?</option>
                                                                                                                                                                                </select></div>
                                                </div>
                                                                                                                                                    <div class="input-field col s12 m8" onclick="event.stopPropagation();" style="display: none;">
                                                    <div class="select-wrapper validate"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-5a5f48c7-62c9-c2e3-8094-d0bc2b78fcbf" value="Request Type"><ul id="select-options-5a5f48c7-62c9-c2e3-8094-d0bc2b78fcbf" class="dropdown-content select-dropdown "><li class="disabled "><span>Request Type</span></li><li class=""><img alt="" src="http://resellers.ecutech.tech/assets/img/change_prepared.svg" class="left"><span>New upload</span></li></ul><select name="new_request[request_type_TCU]" class="validate initialized" data-select-id="5a5f48c7-62c9-c2e3-8094-d0bc2b78fcbf">
                                                        <option value="" disabled="" selected="">Request Type</option>
                                                                                                                                                                                            <option value="new" data-icon="http://resellers.ecutech.tech/assets/img/change_prepared.svg" class="left">New upload</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </select></div>
                                                </div>
                                                                                            <div class="input-field col s12">
                                            <small><i class="fa fa-info-circle"></i> To edit reading tool list <a href="/en/client/account#readingtools" target="_blank">click here</a></small>
                                            </div>
                                            <div class="input-field col s12" onclick="event.stopPropagation();">
                                                <div class="select-wrapper validate"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-bfb8de4a-00b0-c43d-572c-fe4667d9c18d" value="Select your reading tool"><ul id="select-options-bfb8de4a-00b0-c43d-572c-fe4667d9c18d" class="dropdown-content select-dropdown "><li class=""><span>Select your reading tool</span></li><li class=""><img alt="" src="https://www.shiftech.eu/media/olsx/tools/4ebbd61393fb57d18efc69471b790e06.png"><span>Flex (magic) (master)</span></li><li class=""><img alt="" src="https://www.shiftech.eu/media/olsx/tools/4283215581bc46c7f5a4687a35c45e31.png"><span>Flex (magic) (slave)</span></li><li class=""><img alt="" src="https://www.shiftech.eu/media/olsx/tools/91a3d9a2b397a204bba5d68e69d604d4.png"><span>K-Tag (master)</span></li><li class=""><img alt="" src="https://www.shiftech.eu/media/olsx/tools/3e1e83cf8d1822fa03253b503673e2bd.png"><span>Kess V2 (master)</span></li></ul><select id="new_request_readingTool" name="new_request[readingTool]" required="required" class="validate initialized" placeholder="Reading Tool" data-select-id="bfb8de4a-00b0-c43d-572c-fe4667d9c18d"><option value="" selected="selected">Select your reading tool</option><option value="22" data-icon="https://www.shiftech.eu/media/olsx/tools/4ebbd61393fb57d18efc69471b790e06.png">Flex (magic) (master)</option><option value="30" data-icon="https://www.shiftech.eu/media/olsx/tools/4283215581bc46c7f5a4687a35c45e31.png">Flex (magic) (slave)</option><option value="7" data-icon="https://www.shiftech.eu/media/olsx/tools/91a3d9a2b397a204bba5d68e69d604d4.png">K-Tag (master)</option><option value="5" data-icon="https://www.shiftech.eu/media/olsx/tools/3e1e83cf8d1822fa03253b503673e2bd.png">Kess V2 (master)</option></select></div>
                                            </div>
                                            <div class="file-field input-field col s12">
                                                <div class="btn">
                                                    <span><i class="mdi-editor-attach-file"></i></span>
                                                    <input type="file" name="file" class="" id="new-request-attachment">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" required="" name="new_request[attachment]" type="text" placeholder="File">
                                                </div>
                                            </div>


                                            

                                        </div>
                                    </div>
                                    <div class="tab-footer">
                                        <div class="center">
                                            <button class="btn btn-red waves-effect waves-light submit-new-request" disabled=""><i class="mdi-content-send right"></i>Next</button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="new_request__token" name="new_request[_token]" value="2881930d5481b4ed1d1a94b87.-OnZEA3GGZwz3fYabzsAZF0w1GU37N7p630KyfS5UPE.k6WTQkqLd8Zb6rpIAHNOI2xn-Qhjrp_dsj9dvL3LCJqx35JlY69Q-2ersw"></form>
                                                                        </div>
                            <div id="add-event" class="col s12" style="display: none;">
                                <form action="/en/client/file-history/MTI1MDkxOjE2NjMyMzgwNjk/save-note" method="post" enctype="multipart/form-data" name="file-note" novalidate="novalidate">
                                    <div class="tab-content">
                                        <div class="row">
                                            <div class="col s12">
                                                <p>Add internal note to vehicle's timeline
                                                <br>
                                                <small class="blue-olsx-text"><i class="fa fa-warning"></i> You are the only one to see this information, engineers are not notified. This is not a support
                request.
            </small>
                                                </p>
                                            </div>
                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea" required="" name="file-note[comments]" placeholder="Internal note description."></textarea>
                                            </div>
                                            <div class="file-field input-field col s12">
                                                <div class="btn">
                                                    <span><i class="mdi-editor-attach-file"></i></span>
                                                    <input type="file" name="file" id="file-note-attachment">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" name="file-note[attachment]" type="text" placeholder="Optional attachment">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-footer">
                                        <div class="center">
                                            <button class="btn btn-red waves-effect waves-light"><i class="mdi-content-send right"></i>Add to timeline</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        <ul class="timeline-list">
                                                                                                                                                    <li class="timeline-event" id="event-44dc916b0f25ac2bffc5720eb25693dc">
<div class="timeline-icon alert-blue">
    <i class="mdi-file-file-download"></i>
</div>
<div class="timeline-content">
    <span class="push-bit">File received</span>
    <ul class="actions-list">
                                        </ul>
    <small class="timeline-time-small">2022-04-13 13:30:24</small>
                        <div class="divider"></div>
        <span class="red-olsx-text">Filename :</span>
        <span>
            Mercedes-Sprinter-2006 - W906-218/318/518 CDI (3.0)-WDB9066531S228957-1.flex            </span>
                            
            <div class="divider"></div>
    <div>
        <ul class="tabs">
            <li class="tab upload">
                <a href="#add-results-44dc916b0f25ac2bffc5720eb25693dc" class="add-results active">
                    <i class="custom-icon-satisfaction "></i>
                    <span>
                        Results
                    </span>
                </a>
            </li>
            <li class="tab upload">
                <a href="#add-curve-44dc916b0f25ac2bffc5720eb25693dc" class="add-curve">
                    <i class="custom-icon-dyno "></i>
                    <span>
                        Dynosheet
                    </span>
                </a>
            </li>
            <li class="tab upload">
                <a href="#add-logs-44dc916b0f25ac2bffc5720eb25693dc" class="add-logs">
                    <i class="custom-icon-datalog "></i>
                    <span>
                        Logs
                    </span>
                </a>
            </li>
        <li class="indicator" style="display: none; right: 540px; left: 0px;"></li></ul>
    </div>
    <div class="row received-add-form" style="display: none;">
        <div id="add-curve-44dc916b0f25ac2bffc5720eb25693dc" class="col s12 push-bit m-t-em" style="display: none;">
            <form action="/en/client/file-history/save-curve/MTI1MDkxOjE2NjMyMzgwNjk/150361/received" method="post" enctype="multipart/form-data" name="file-curve" data-id="44dc916b0f25ac2bffc5720eb25693dc" novalidate="novalidate">
                <div class="tab-content">
                    <div class="row">
                        <div class="col s12">
                            <p>Upload and watch the dynosheet</p>
                        </div>
                        <div class="file-field input-field col s12">
                            <div class="btn">
                                <span><i class="mdi-editor-attach-file"></i></span>
                                <input type="file" name="file" id="file-curve-attachment-44dc916b0f25ac2bffc5720eb25693dc">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" required="" name="file-curve[attachment]" type="text" placeholder="Select dyno sheet (JPG, JPEG, PNG, GIF, PDF)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-footer">
                    <div class="row m-n">
                        <div class="col s12 center">
                            <button class="btn btn-red waves-effect waves-light mt"><i class="mdi-content-send right"></i>Add to timeline</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="add-logs-44dc916b0f25ac2bffc5720eb25693dc" class="col s12 push-bit m-t-em" style="display: none;">
            <form action="/en/client/file-history/save-log/MTI1MDkxOjE2NjMyMzgwNjk/150361/received" method="post" enctype="multipart/form-data" name="file-log" novalidate="novalidate">
                <div class="tab-content">
                    <div class="row">
                        <div class="col s12">
                            <p>Upload and watch the datalogs</p>
                        </div>
                        <div class="file-field input-field log-url-field col s12">
                            <input class="validate" name="file-log[url]" type="text" pattern="^(http(s){0,1}:\/\/){0,1}(?:(log\.malonetuning\.com)|(log\.tunezilla\.com)|(www\.autotuner-tool\.com))\/[^ ]{0,450}$" placeholder="Url of datalogs" required="required">
                        </div>
                    </div>
                </div>
                <div class="tab-footer">
                    <div class="row m-n">
                        <div class="col s12 center">
                            <button class="btn btn-red waves-effect waves-light mt" type="submit"><i class="mdi-content-send right"></i>Add to timeline</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="add-results-44dc916b0f25ac2bffc5720eb25693dc" class="col s12 push-bit m-t-em active">
            <form action="/en/client/file-history/save-results/MTI1MDkxOjE2NjMyMzgwNjk/150361/received" method="post" enctype="application/x-www-form-urlencoded" name="file-results" novalidate="novalidate">
                <div class="tab-content">
                    <div class="row">
                        <div class="col s12">
                            <p>Add results</p>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="power" type="text" class="validate" required="" name="file-results[power]" placeholder="Power (hp)">
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="torque" type="text" class="validate" required="" name="file-results[torque]" placeholder="Torque (Nm)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="satisfaction-selector">
                            <input id="extremelyunsatisfied-44dc916b0f25ac2bffc5720eb25693dc" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="extremelyunsatisfied">
                            <label class="drinkcard-satisfaction extremelyunsatisfied" for="extremelyunsatisfied-44dc916b0f25ac2bffc5720eb25693dc"></label>
                            <input id="unsatisfied-44dc916b0f25ac2bffc5720eb25693dc" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="unsatisfied">
                            <label class="drinkcard-satisfaction unsatisfied" for="unsatisfied-44dc916b0f25ac2bffc5720eb25693dc"></label>
                            <input id="satisfied-44dc916b0f25ac2bffc5720eb25693dc" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="satisfied">
                            <label class="drinkcard-satisfaction satisfied" for="satisfied-44dc916b0f25ac2bffc5720eb25693dc"></label>
                            <input id="extremelysatisfied-44dc916b0f25ac2bffc5720eb25693dc" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="extremelysatisfied">
                            <label class="drinkcard-satisfaction extremelysatisfied" for="extremelysatisfied-44dc916b0f25ac2bffc5720eb25693dc"></label>
                        </div>
                    </div>
                </div>
                <div class="tab-footer">
                    <div class="row m-n">
                        <div class="col s12 center">
                            <button class="btn btn-red waves-effect waves-light mt"><i class="mdi-content-send right"></i>Add to timeline</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        </div>
</li>

                                    
                                                                                                                                                                                                                                                                                                                                                                    



<li class="timeline-event " id="event-7c465a885f5f294a53a057d1b543ec77">
<div class="timeline-icon-subevent">
                                <img src="/assets/img/OLSXpp.jpeg" alt="" class="timeline-avatar">
                    </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message received
                </span>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 15:42:04</small>
        </div>
        <div class="col s6 right-align">
                        </div>
    </div>
    <div class="divider"></div>
                                <p class="push-bit">
        
    </p><p class="push-bit"> Sorry, I made a mistake, I would like to say "disconnect EGT" sensors  (but you can keep the EGR disconnected)</p>
                <p class="push-bit"> </p>
            <p></p>
</div>
                                        
            
</li>

<li class="timeline-event " id="event-5c09b8ce140e92a764b5d65c2ee12c7a">
<div class="timeline-icon-subevent">
                <img src="/assets/img/default.png" alt="" class="timeline-avatar">
        </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message sent
                </span>
                <ul class="actions-list">
            <li>
                <a class="btn tooltipped delete" href="/en/client/vehicle-history/MTI1MDkxOjE2NjMyMzgwNjk/delete-event/comment/Mjk5NjY5OjE2NjMyNDAwMTA/received" data-position="bottom" data-delay="50" data-tooltip="Delete" data-tooltip-id="38c45f8b-9e93-0c03-ee24-f553e430d1bf">
                    <i class="mdi-action-delete"></i>
                </a>
            </li>
        </ul>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 14:37:15</small>
        </div>
        <div class="col s6 right-align">
                                                        <small class="read"><i class="mdi-navigation-check"></i>Seen the 2022/08/30 at 14:40</small>
                                            </div>
    </div>
    <div class="divider"></div>
                                <p class="push-bit">
        
    </p><p class="push-bit"> We disconnected EGR &amp; pressure sensors and we get the same results. Is this cause the file is .maps and we need to read the ecu on bench and get the int flash?<br>
<br>
</p>
            <p></p>
</div>
                                        
            
</li>

        <li class="timeline-event " id="event-c83ce053524552f37bb739c86a20c5de">
<div class="timeline-icon-subevent">
                                <img src="/assets/img/OLSXpp.jpeg" alt="" class="timeline-avatar">
                    </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message received
                </span>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 13:37:48</small>
        </div>
        <div class="col s6 right-align">
                        </div>
    </div>
    <div class="divider"></div>
                                <p class="push-bit">
        
    </p><p class="push-bit"> file was good, you just need to disconnect the sensors</p>
                <p class="push-bit"> </p>
            <p></p>
</div>
                                        
            
        <a href="#!" class="show-more waves-effect waves-light" data-event="MzIyNDcyOjE2NjMyNDAwMTA">Show more<i class="mdi-navigation-expand-more"></i></a>
</li>

        <li class="timeline-event hide event-MzIyNDcyOjE2NjMyNDAwMTA" id="event-8c6613f5c209aaf70a4fa6f00962b7ef">
<div class="timeline-icon-subevent">
                <img src="/assets/img/default.png" alt="" class="timeline-avatar">
        </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message sent
                </span>
                <ul class="actions-list">
            <li>
                <a class="btn tooltipped delete" href="/en/client/vehicle-history/MTI1MDkxOjE2NjMyMzgwNjk/delete-event/comment/Mjk5NjM0OjE2NjMyNDAwMTA/received" data-position="bottom" data-delay="50" data-tooltip="Delete" data-tooltip-id="608b4a8f-53da-c0d8-94a3-49c7a1f65b82">
                    <i class="mdi-action-delete"></i>
                </a>
            </li>
        </ul>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 13:34:19</small>
        </div>
        <div class="col s6 right-align">
                                                        <small class="read"><i class="mdi-navigation-check"></i>Seen the 2022/08/30 at 13:37</small>
                                            </div>
    </div>
    <div class="divider"></div>
                                <p class="push-bit">
        
    </p><p class="push-bit"> You said i have to disconnect EGR &amp; pressure sensors. Are you going to send me the file? </p>
            <p></p>
</div>
                                        
            
</li>

        <li class="timeline-event hide event-MzIyNDcyOjE2NjMyNDAwMTA" id="event-73cb13225070c029f9c346d7f7ef2e3b">
<div class="timeline-icon-subevent">
                                <img src="/assets/img/OLSXpp.jpeg" alt="" class="timeline-avatar">
                    </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message received
                </span>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 12:54:39</small>
        </div>
        <div class="col s6 right-align">
                        </div>
    </div>
    <div class="divider"></div>
                                <p class="push-bit">
        
    </p><p class="push-bit"> disconnect EGT &amp; pressure sensors</p>
                <p class="push-bit"> </p>
            <p></p>
</div>
                                        
            
</li>

        <li class="timeline-event hide event-MzIyNDcyOjE2NjMyNDAwMTA" id="event-7e01aa7816e077bcf109c247695db6b9">
<div class="timeline-icon-subevent">
                <img src="/assets/img/default.png" alt="" class="timeline-avatar">
        </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message sent
                </span>
                <ul class="actions-list">
            <li>
                <a class="btn tooltipped delete" href="/en/client/vehicle-history/MTI1MDkxOjE2NjMyMzgwNjk/delete-event/comment/Mjk5NjIxOjE2NjMyNDAwMTA/received" data-position="bottom" data-delay="50" data-tooltip="Delete" data-tooltip-id="d424c613-cb12-b628-90e4-b0681e5c366f">
                    <i class="mdi-action-delete"></i>
                </a>
            </li>
        </ul>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 12:47:16</small>
        </div>
        <div class="col s6 right-align">
                                                        <small class="read"><i class="mdi-navigation-check"></i>Seen the 2022/08/30 at 12:53</small>
                                            </div>
    </div>
    <div class="divider"></div>
                                <p class="push-bit">
        
    </p><p class="push-bit"> When the vehicle is at idle it is normal and we dont have white or black smoke.When the engine reach normal temp we have white smoke.</p>
                <p class="push-bit"> </p>
            <p></p>
</div>
                                        
            
</li>

        <li class="timeline-event hide event-MzIyNDcyOjE2NjMyNDAwMTA" id="event-960bd23ed9e57c942fef70b298be3578">
<div class="timeline-icon-subevent">
                                <img src="/assets/img/OLSXpp.jpeg" alt="" class="timeline-avatar">
                    </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message received
                </span>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 12:17:39</small>
        </div>
        <div class="col s6 right-align">
                        </div>
    </div>
    <div class="divider"></div>
                                <p class="push-bit">
        
    </p><p class="push-bit"> Can you please send me a new fresh read (even in master) because files are saved 15 day's on the server</p>
                <p class="push-bit"> </p>
            <p></p>
</div>
                                        
            
</li>

        <li class="timeline-event hide event-MzIyNDcyOjE2NjMyNDAwMTA" id="event-28b23d6d7c614a0ac380a9c9370cc27f">
<div class="timeline-icon-subevent">
                <img src="/assets/img/default.png" alt="" class="timeline-avatar">
        </div>
<div class="timeline-content-subevent">
    <span class="push-bit">
                        Message sent
                </span>
                <ul class="actions-list">
            <li>
                <a class="btn tooltipped delete" href="/en/client/vehicle-history/MTI1MDkxOjE2NjMyMzgwNjk/delete-event/comment/Mjk5NjA0OjE2NjMyNDAwMTA/received" data-position="bottom" data-delay="50" data-tooltip="Delete" data-tooltip-id="90f63992-28be-bca6-6207-a51e88de1949">
                    <i class="mdi-action-delete"></i>
                </a>
            </li>
        </ul>
            <div class="row m-b-none">
        <div class="col s6">
            <small class="timeline-time-small">2022-08-30 12:10:12</small>
        </div>
        <div class="col s6 right-align">
                                                        <small class="read"><i class="mdi-navigation-check"></i>Seen the 2022/08/30 at 12:16</small>
                                            </div>
    </div>
    <div class="divider"></div>
                                <div class="row m-n">
                <div class="col s12">
                    <ul class="collection">
                                                        <li class="collection-item black-olsx-text">
                                <div>Problem on the vehicle<span class="secondary-content"><i class="mdi-navigation-check red-olsx-text"></i></span></div>
                            </li>
                                                        <li class="collection-item black-olsx-text">
                                <div>Other<span class="secondary-content"><i class="mdi-navigation-check red-olsx-text"></i></span></div>
                            </li>
                                                </ul>
                </div>
            </div>
                        <p class="push-bit">
        
    </p><p class="push-bit"> When the engine is cold we have white smoke, when the engine reach normal temp we have black smoke, when you done this file the customer tool was slave to you, now the tool is linked to our master, so please send us the file in open format to crypt it to our customers slave</p>
            <p></p>
</div>
                                        
            
</li>




                                                                                                                                                            <li class="timeline-event" id="event-2584b3a9bca7ea13385d234e47dd00cb">
<div class="timeline-icon  light-green lighten-1">
    <i class="mdi-file-file-upload"></i>
</div>
<div class="timeline-content">
            <span class="push-bit">File sent</span>
    <ul class="actions-list">
        <li>
            <span class="label-credit credit-history " data-id="request-2584b3a9bca7ea13385d234e47dd00cb" style="cursor: pointer">
                -
                                        9
                                    Credits
                </span>
        </li>
                    
    </ul>
    <small class="timeline-time-small">2022-04-13 13:11:48</small>
    <div class="divider"></div>
    <p class="push-bit m-t-em">
        The file has been sent to engineers with the following request :
    </p>


                                            <div class="chip-stage">
                                        <img src="https://www.shiftech.eu/media/olsx/tunings/icons/06b67cee92e4fea2919e83d6fa2a8edd.svg" alt="">
                                    Stock (no remap - only options)
                                </div>
                                                        <div class="chip-stage">
                                                <img src="https://www.shiftech.eu/media/olsx/options/icons/29c2dd7e1e2cf29fd7d5038d47022958.svg" alt="">
                                            EGR OFF
                                        </div>
                                                    <div class="chip-stage">
                                                <img src="https://www.shiftech.eu/media/olsx/options/icons/20f24f635d2597c65d620d977d5fd185.svg" alt="">
                                            DPF OFF
                                        </div>
                                                                                <div class="divider"></div>
        <p class="push-bit">
            <span class="red-olsx-text">Reading tool : </span>
            <span class="chip-stage">
                <img src="https://www.shiftech.eu/media/olsx/tools/4283215581bc46c7f5a4687a35c45e31.png" class="tool-logo-small"> SLAVE                 </span>
                        </p>
                        <div class="divider"></div>
                                <p class="push-bit">
            <span class="red-olsx-text">Brand Group: </span> <img src="https://storage.googleapis.com/olsx_images/Intellitune_Brands_Group/mercedes.png" alt="Mercedes group" class="feedback-logo">
        </p>
                                                <p class="push-bit">
                <span class="red-olsx-text">ECU: </span>
                                <img src="https://storage.googleapis.com/olsx_images/Intellitune_Manufacturers/bosch.svg" alt="Bosch" class="feedback-logo m-r-xs">
                                EDC16CP31_CR40
            </p>
                                                <p class="push-bit">
                <span class="red-olsx-text">Engine Code: </span> OM642DE30
            </p>
                                    <p class="push-bit">
                <span class="red-olsx-text">Engine name: </span> 280-320CDI
            </p>
                                    <p class="push-bit">
                <span class="red-olsx-text">Displacement: </span> 3.0                </p>
                                    <p class="push-bit">
                <span class="red-olsx-text">Power: </span> 190-224 hp
            </p>
                                    <p class="push-bit">
                <span class="red-olsx-text">Torque: </span> 440-510 Nm
            </p>
                                    <p class="push-bit">
                <span class="red-olsx-text">Software ID 1: </span> 1037386921P409
            </p>
                                <div class="divider"></div>
    <div>
        <ul class="tabs">
            <li class="tab upload">
                <a href="#add-results-2584b3a9bca7ea13385d234e47dd00cb" class="add-results active">
                    <i class="custom-icon-satisfaction "></i>
                    <span>
                        Results
                    </span>
                </a>
            </li>
            <li class="tab upload">
                <a href="#add-curve-2584b3a9bca7ea13385d234e47dd00cb" class="add-curve">
                    <i class="custom-icon-dyno "></i>
                    <span>
                        Dynosheet
                    </span>
                </a>
            </li>
            <li class="tab upload">
                <a href="#add-logs-2584b3a9bca7ea13385d234e47dd00cb" class="add-logs">
                    <i class="custom-icon-datalog "></i>
                    <span>
                        Logs
                    </span>
                </a>
            </li>
        <li class="indicator" style="display: none; right: 540px; left: 0px;"></li></ul>
    </div>
    <div class="row request-add-form" style="display: none;">
        <div id="add-curve-2584b3a9bca7ea13385d234e47dd00cb" class="col s12 push-bit m-t-em" style="display: none;">
            <form action="/en/client/file-history/save-curve/MTI1MDkxOjE2NjMyMzgwNjk/129182/request" method="post" enctype="multipart/form-data" name="file-curve" data-id="2584b3a9bca7ea13385d234e47dd00cb" novalidate="novalidate">
                <div class="tab-content">
                    <div class="row">
                        <div class="col s12">
                            <p>Upload and watch the dynosheet</p>
                        </div>
                        <div class="file-field input-field col s12">
                            <div class="btn">
                                <span><i class="mdi-editor-attach-file"></i></span>
                                <input type="file" name="file" id="file-curve-attachment-2584b3a9bca7ea13385d234e47dd00cb">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" required="" name="file-curve[attachment]" type="text" placeholder="Select dyno sheet (JPG, JPEG, PNG, GIF, PDF)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-footer">
                    <div class="row m-n">
                        <div class="col s12 center">
                            <button class="btn btn-red waves-effect waves-light mt"><i class="mdi-content-send right"></i>Add to timeline</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="add-logs-2584b3a9bca7ea13385d234e47dd00cb" class="col s12 push-bit m-t-em" style="display: none;">
            <form action="/en/client/file-history/save-log/MTI1MDkxOjE2NjMyMzgwNjk/129182/request" method="post" enctype="multipart/form-data" name="file-log" novalidate="novalidate">
                <div class="tab-content">
                    <div class="row">
                        <div class="col s12">
                            <p>Upload and watch the datalogs</p>
                        </div>
                        <div class="file-field input-field log-url-field col s12">
                            <input class="validate" name="file-log[url]" type="text" pattern="^(http(s){0,1}:\/\/){0,1}(?:(log\.malonetuning\.com)|(log\.tunezilla\.com)|(www\.autotuner-tool\.com))\/[^ ]{0,450}$" placeholder="Url of datalogs" required="required">
                        </div>
                    </div>
                </div>
                <div class="tab-footer">
                    <div class="row m-n">
                        <div class="col s12 center">
                            <button class="btn btn-red waves-effect waves-light mt" type="submit"><i class="mdi-content-send right"></i>Add to timeline</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="add-results-2584b3a9bca7ea13385d234e47dd00cb" class="col s12 push-bit m-t-em active">
            <form action="/en/client/file-history/save-results/MTI1MDkxOjE2NjMyMzgwNjk/129182/request" method="post" enctype="application/x-www-form-urlencoded" name="file-results" novalidate="novalidate">
                <div class="tab-content">
                    <div class="row">
                        <div class="col s12">
                            <p>Add results</p>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="power" type="text" class="validate" required="" name="file-results[power]" placeholder="Power (hp)">
                                                        </div>
                        <div class="input-field col s12 m6">
                            <input id="torque" type="text" class="validate" required="" name="file-results[torque]" placeholder="Torque (Nm)">
                                                        </div>
                    </div>
                    <div class="row">
                        <div class="satisfaction-selector">
                            <input id="extremelyunsatisfied-2584b3a9bca7ea13385d234e47dd00cb" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="extremelyunsatisfied">
                            <label class="drinkcard-satisfaction extremelyunsatisfied" for="extremelyunsatisfied-2584b3a9bca7ea13385d234e47dd00cb"></label>
                            <input id="unsatisfied-2584b3a9bca7ea13385d234e47dd00cb" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="unsatisfied">
                            <label class="drinkcard-satisfaction unsatisfied" for="unsatisfied-2584b3a9bca7ea13385d234e47dd00cb"></label>
                            <input id="satisfied-2584b3a9bca7ea13385d234e47dd00cb" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="satisfied">
                            <label class="drinkcard-satisfaction satisfied" for="satisfied-2584b3a9bca7ea13385d234e47dd00cb"></label>
                            <input id="extremelysatisfied-2584b3a9bca7ea13385d234e47dd00cb" type="radio" name="file-results[satisfaction]" required="" data-error=".satisfaction-selector" value="extremelysatisfied">
                            <label class="drinkcard-satisfaction extremelysatisfied" for="extremelysatisfied-2584b3a9bca7ea13385d234e47dd00cb"></label>
                        </div>
                    </div>
                </div>
                <div class="tab-footer">
                    <div class="row m-n">
                        <div class="col s12 center">
                            <button class="btn btn-red waves-effect waves-light mt"><i class="mdi-content-send right"></i>Add to timeline</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</li>

<div id="request-2584b3a9bca7ea13385d234e47dd00cb" class="modal" style="max-width: 600px; z-index: 1003;">
<div class="modal-content center">
    <h3>Transaction history</h3>
            <table>
        <thead>
            <tr><th>Date</th>
            <th>Credits</th>
            <th>Origin</th>
        </tr></thead>
                <tbody><tr><td>2022-04-13</td>
                                <td><label class="label label-credit-admin red">-9</label></td>
                            <td><strong>
                                                User
                                        </strong></td></tr>
            </tbody></table>
            <div class="center m-t-md">
    <button class="waves-effect waves-light btn btn-red modal-action modal-close" type="button" id="closeConfirmation">
        Close
    </button>
    </div>
</div>
</div>



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
                        <form action="/en/client/file-history/MTI1MDkxOjE2NjMyMzgwNjk/update-memo" class="car-info-form" name="car-info" enctype="application/x-www-form-urlencoded" method="post" novalidate="novalidate">
                            <h3 class="id-info">Car information</h3>

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
                                <input type="text" name="licence_plate]" value="{{$file->license_plate}}" class="validate vehicle-id-input">
                            </p>
                            <p>
                                1st registration year
                                <input type="text" name="first_registration" value="2006" class="validate vehicle-id-input" pattern="[0-9]{4}">
                            </p>
                            <p>
                                Mileage
                                <input type="text" name="kilometrage" value="" class="validate vehicle-id-input" pattern="[0-9]{0,12}">
                            </p>

                                                            <div class="input-field ">
                                <textarea id="car-info-memo" name="car-info[memo]" class="materialize-textarea" placeholder="Internal note related to the vehicle :"></textarea>
                            </div>
                            <div class="center">
                                <button type="submit" name="car-info[submit]" class="btn btn-clear waves-effect waves-light btn-vehicle-id">
                                    Save <i class="mdi-content-save right submit-icon"></i>
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
                            <form action="/en/client/file-history/MTI1MDkxOjE2NjMyMzgwNjk/update-customer" class="customer-info-form" name="customer-info" enctype="application/x-www-form-urlencoded" method="post" novalidate="novalidate">
                                <input type="hidden" name="customer-info[id]" value="NDc0MzM6MTY2MzI0MDAxMA">
                                <span class="id-info">Customer information</span>
                                <div class="input-field ">
                                    <i class="mdi-action-account-circle prefix"></i>
                                    <input id="icon_prefix" type="text" class="validate" required="" name="name" value="{{$file->name}}" placeholder="Customer name">
                                </div>
                                <div class="input-field">
                                    <i class="mdi-communication-phone prefix"></i>
                                    <input id="icon_telephone" type="tel" class="validate" name="phoe" value="{{$file->phone}}" placeholder="Phone">
                                </div>
                                <div class="input-field">
                                    <i class="mdi-communication-email prefix"></i>
                                    <input id="icon_telephone" type="email" class="validate" name="email" value="{{$file->email}}" placeholder="Email">
                                </div>
                                <div class="input-field ">
                                    <textarea id="icon_prefix2" class="materialize-textarea" name="customer-info[notes]" placeholder="Internal note related to the customer :"></textarea>
                                </div>
                                <div class="center">
                                    <button class="btn btn-clear waves-effect waves-light btn-vehicle-id" type="submit" name="customer-info[submit]">
                                        Save <i class="mdi-content-save right submit-icon"></i>
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
</script>
@endsection