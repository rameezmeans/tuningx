@extends('layouts.app')

@section('pagespecificstyles')

<style>
    .chip-option img {
        height: auto;
        margin: 0 0.7em 0 0;
        vertical-align: middle;
        width: 2.5em;
    }

    .chip-stage {
        background-color: #fff;
        border-radius: 0.5em;
        color: #494c53;
        display: block;
        font-size: .8em;
        font-weight: 400;
        height: 2.5em;
        line-height: 2.5em;
        padding: 0 0.8em;
    }

    .chip-option {
        background-color: #fff;
        border-radius: 0.5em;
        color: #494c53;
        display: block;
        font-size: .8em;
        font-weight: 400;
        height: 2.5em;
        line-height: 2.5em;
        padding: 0 0.8em;
        margin: 0.5em 0.3em;
    }

    .stage-price-container {
        position: relative;
    }

    .stage-price-card {
        visibility: hidden;
        width: 100%;
        background-color: lightgray;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        
        /* Position the tooltip */
        position: absolute;
        z-index: 9999;
        top: 100%;
        left: 4.3rem;
        margin-left: -60px;
    }


    .stage-price-container:hover .stage-price-card {
        visibility: visible;
        color:black
    }

    .option-price-container {
        position: relative;
    }

    .option-price-container:hover .option-price-card {
        visibility: visible;
        color:black
    }

    .option-price-card {
        visibility: hidden;
        width: 100%;
        background-color: lightgray;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        
        /* Position the tooltip */
        position: absolute;
        z-index: 9999;
        top: 100%;
        left: 4.3rem;
        margin-left: -60px;
    }


</style>

@endsection

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1 class="h1-olsx-history">{{__('Price List')}}</h1>
        <div class="table-history-panel">
            <div class="row price-panel">
                <div class="col s12 m6">
                    <div class="center">
                        <h2>Tunings</h2>
                    </div>
                        @foreach ($stages as $stage)
                            <div class="stage-price-container">
                                <div class="slave-red chip-stage chip-stage-stage0 waves-effect waves-block waves-light z-depth-1" data-price="{{$stage['credits']}}">
                                    <img src="{{'https://backend.ecutech.gr/icons/'.$stage['icon']}}" alt="{{$stage['name']}}">
                                    {{$stage['name']}}
                                    <strong class="m-l-md"> {{$stage['credits']}} credits</strong>
                                    </div>
                                    <div class="stage-price-card slave-red">
                                        <p>{{$stage['description']}}</p>
                                </div>
                            </div>
                        @endforeach
                            
                        {{-- <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-stage1 waves-effect waves-block waves-light z-depth-1" data-price="12">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/75b290550edec54fa250eb44672ada4d.svg" alt="Stage 1">
                                                                        Stage 1
                                                                    <strong class="m-l-md"> 12 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>The stage 1 is a tuning of the engine management without the addition of mechanical parts.  Stage 1 is both reliable and efficient while delivering first-class performance.</p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-stage1+ waves-effect waves-block waves-light z-depth-1" data-price="14">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/a8fd42aecf0daae0758527131d736ed8.svg" alt="Stage 1+">
                                                                        Stage 1+
                                                                    <strong class="m-l-md"> 14 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>Stage 1+ is an upgrade to stage 1 only possible if you have a dyno and logs available. The base will be a stage 1 file which can be improved based on the logs and curves provided. If you do not have a bench or log equipment, we advise you to go to stage 1.</p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-stage2 waves-effect waves-block waves-light z-depth-1" data-price="16">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/92351f1b0cf15d331005c5f5f3b82d6d.svg" alt="Stage 2">
                                                                        Stage 2
                                                                    <strong class="m-l-md"> 16 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>Stage 2 is a high-performance engine reprogramming associated with a material modification carried out on the vehicle. Stage 2 on a diesel engine constitutes the removal of the EGR valve, the particle filter (DPF) and the speed limit. Stage 2 on a gasoline engine takes into account a modification of the exhaust line, the removal of the catalyst and also the deactivation of the speed limit. It removes also all related faults. </p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-stage3 waves-effect waves-block waves-light z-depth-1" data-price="55">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/452901b12de422ee5b311909266e488a.svg" alt="Stage 3">
                                                                        Stage 3
                                                                    <strong class="m-l-md"> 55 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>Stage 3 is a tuning of the engine management with the addition of mechanical parts. Stage 3 is a tailor-made preparation according to the parts installed in your engine.  Stage 3 on a diesel engine constitutes the removal of the EGR valve, the particle filter (DPF) and the speed limit. Stage 3 on a gasoline engine takes into account a modification of the exhaust line, the removal of the catalyst, the removal of the particule filter (GPF) and also the deactivation of the speed limit. It removes also all related faults. Please note, we reserve the right to refuse a stage 3 request. Before clicking on the option, make sure you have received confirmation from the team that the stage 3 has been already developed for your vehicle.</p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-dsg waves-effect waves-block waves-light z-depth-1" data-price="12">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/e85b5bbab22c805921650430ac81581a.svg" alt="Gearbox">
                                                                        Gearbox
                                                                    <strong class="m-l-md"> 12 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>The DSG gearbox (dual clutch) allows quick gearshifting but does not deliver its full potential so far. With the reprogramming we are working on several parameters:
                Decreased gear change time,
                Increasing maximum engine speed (rpm/min),
                Increasing the maximum torque,
                Removing kick-down,
                Improving responsiveness.</p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-ecux waves-effect waves-block waves-light z-depth-1" data-price="0">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/ca012b164651a36f9e8be626d9975e32.svg" alt="ECUx">
                                                                        ECUx
                                                                    <strong class="m-l-md"> 0 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>It's the file dedicated to your ECUx external ECU.</p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-ori_vr waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/4a5eba7056367b485bd4227ae4b138f1.svg" alt="Remise origine via Virtual Read">
                                                                        Back to stock (Virtual Read)
                                                                    <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>You just uploaded a virtual read file and you want to receive the file ready to flash</p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-ori waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/307ea1118bff970e340e04d72de9726f.svg" alt="Remise origine">
                                                                        Back to stock
                                                                    <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>You just uploaded a tuned file and you need to reset the options to their original default
                values.
            </p>
                            </div>
                        </div>
                                                <div class="stage-price-container">
                            <div class="slave-red chip-stage chip-stage-analyze waves-effect waves-block waves-light z-depth-1" data-price="2">
                                <img src="https://www.shiftech.eu/media/olsx/tunings/icons/2283697058f6cdb5ecf45f891df9749e.svg" alt="Analyse de la gestion moteur">
                                                                        Tuning file review
                                                                    <strong class="m-l-md"> 2 credits</strong>
                            </div>
                            <div class="stage-price-card slave-red">
                                <p>The purpose of the engine management analysis by OLSx is to give you an opinion on the
                modifications made to the file sent. If you decide to entrust us with this file for a new engine
                management, we will deduct the two credits related to the analysis to you. Please note, only a real
                (non-virtual) reading can be analyzed. If the file is considered by our system to be original, the
                ticket will be closed.
            </p>
                            </div> --}}
                        {{-- </div> --}}
                                        </div>
                <div class="col s12 m6">
                    <div class="center">
                        <h2>Options</h2>
                    </div>
                    @foreach($options as $option)
                        <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="{{$option['credits']}}">
                                <img src="{{'https://backend.ecutech.gr/icons/'.$option['icon']}}" alt="{{$option['name']}}">
                                {{$option['name']}}
                                <strong class="m-l-md"> {{$option['credits']}} credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>{{$option['description']}}</p>
                            </div>
                        </div>
                        @endforeach
                                                {{-- <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/2a61df79c383902c9659161c1742f421.svg" alt="Cylinder On Demand OFF">
                                Cylinder On Demand OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option desactivates Cylinder On Demand (COD) technology.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/20f24f635d2597c65d620d977d5fd185.svg" alt="DPF OFF">
                                DPF OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option electronically removes only the DPF</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="5">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/6d5ed76c6eb9bff3fb586c5644d98137.svg" alt="DSG farts">
                                DSG farts <strong class="m-l-md"> 5 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>DSG farts are a kind of light pop and bang that you hear when you change gear. Some production
                vehicles have it, some don't and we have the option of adding it.
            </p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/ab7844111598d94030fd3abd43106173.svg" alt="DTC OFF">
                                DTC OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This options delect Default Trouble Code (DTC) of the engine.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/e1117a71721f628f4f88bc8208710a35.svg" alt="Decat (Cat OFF)">
                                Decat (Cat OFF) <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option removes the catalyst light indicator from the dashboard.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="15">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/7bc838e640fd9bb06d8f97eb5402f681.svg" alt="E85 flex-fuel">
                                E85 flex-fuel <strong class="m-l-md"> 15 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This is the conversion that allows the vehicle to run also on bio ethanol fuel.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/29c2dd7e1e2cf29fd7d5038d47022958.svg" alt="EGR OFF">
                                EGR OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option blocks the EGR valve so that there is no more exhaust gas recirculation</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/49695e5efe74f0a2c4de57263663ff24.svg" alt="Exhaust Flaps">
                                Exhaust Flaps <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>The original exhaust valves management partially opens the valves in sport mode, for sound standards reasons. The exhaust flaps option allows the valves to be opened to 100% when sport mode is enabled.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/d676e2aa7e52062ccbe989324d282d39.svg" alt="GPF OFF">
                                GPF OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option electronically removes only the DPF</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="5">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/12dfb67f95af992090a3e28f1c502c8a.svg" alt="Hard Rev Cut">
                                Hard Rev Cut <strong class="m-l-md"> 5 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>Hard Rev Cut allows you to continue up to the maximum revs without the computer intervening, just before the rev limiter. This in turn translates into more power.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/af73ed8ef835eb40315cc41c88b538c9.svg" alt="Hot start fix">
                                Hot start fix <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>On some diesel engines, especially EDC16 VAG, hot starting is problematic. Our solution corrects
                this problem.
            </p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="5">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/dd2e61bf7f17ba461e2e45745f112ac5.svg" alt="Launch Control">
                                Launch Control <strong class="m-l-md"> 5 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>Option that maintains a certain engine speed when the clutch pedal is pressed. This allows starting at the best engine speeds.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="12">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/72fa550d584313798b2be260fc40c38a.svg" alt="Octane adatpation">
                                Octane adatpation <strong class="m-l-md"> 12 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>Octane adaptation.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="5">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/c37e96073e0b6983de9ea51abf0bb830.svg" alt="Pop &amp; Bang">
                                Pop &amp; Bang <strong class="m-l-md"> 5 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>Pop and bang is the result of an ignition delay which creates an exhaust detonation when the
                throttle pedal is released. Caution, this process must only be used on vehicles without catalyst or
                with sport catalyst. This option may impair the reliability of the engine.
            </p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="6">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/d7fd9c8146c328dc0a462758a1ccc872.svg" alt="Pop and Bang Sport Button">
                                Pop and Bang Sport Button <strong class="m-l-md"> 6 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option allows you to have the Pop and Bang in the car's sport mode</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="5">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/4be6cff3408f68cb848107023ddf9d99.svg" alt="Popcorn">
                                Popcorn <strong class="m-l-md"> 5 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This is the hardrev limiter designed for diesel engines.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/1675673491a3d8e018cda87164d07beb.svg" alt="Power on Driving Mode (Sport button)">
                                Power on Driving Mode (Sport button) <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>On some vehicles it is possible to simulate the original power when the vehicle is in normal mode or related to fuel economy. Once you go into a sport mode or similar, the vehicle is then tuned.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="10">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/71118229b3d881ca8398b4c7dc67a605.svg" alt="SCR (ADblue OFF)">
                                SCR (ADblue OFF) <strong class="m-l-md"> 10 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option deactivates the AdBlue.</p>
                            </div>
                        </div>
                        <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/95c283ba25f984dcbb7cf53da3638a37.svg" alt="Sport display">
                                Sport display <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option allows sport display adaptation with new car performances</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/682f92d379d4d0e1327aadd6c7751a9e.svg" alt="Start &amp; Stop OFF">
                                Start &amp; Stop OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>Sometimes the start and stop intervenes intrusively. While we want to restart, the latency of the system is felt and it quickly becomes embarrassing. This option simply removes this feature.</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/10ec0abd3ffa3fd5f463ca1fa15c69c4.svg" alt="Swirl Flap OFF">
                                Swirl Flap OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This option allows you to deactivate the Swirl Flap, a system allowing the air to swirl through
                the intake valves.
            </p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/d2cd60c4c8f373bf6170aef323dad41a.svg" alt="Vmax 30">
                                Vmax 30 <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>Maximum speed limitation to 30km/h</p>
                            </div>
                        </div>
                                                <div class="option-price-container">
                            <div class="slave-red chip-option waves-effect waves-block waves-light z-depth-1" data-price="3">
                                <img src="https://www.shiftech.eu/media/olsx/options/icons/4099130c4d41ff950d633ebb7a4fa285.svg" alt="Vmax OFF">
                                Vmax OFF <strong class="m-l-md"> 3 credits</strong>
                            </div>
                            <div class="option-price-card slave-red">
                                <p>This is an increase of the maximum speed limit or its suppression.</p>
                            </div>
                        </div> --}}
                                        </div>
            </div>
        </div>
        </div>
</main>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">

    $(document).ready(function (e){
        // $(document).on('mouseover', '.stage-price-container', function(e){
        //     console.log($(this).children()[1]);
        //     $($(this).children()[1]).css("visibility", "visible");
        // });

        // $(document).on('mouseout', '.stage-price-container', function(e){
        //     console.log($(this).children()[1]);
        //     $($(this).children()[1]).css("visibility", "hidden");
        // });
    });


</script>

@endsection
