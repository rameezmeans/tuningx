@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
<div class="container">
    <h1>{{__('Dashboard')}}</h1>
    <div class="row no-m-b">
        <div class="col s12">
            @if(Auth::user()->credits->sum('credits') == 0)
                <div class="news-dashboard">
                    <div class="card-header alert-message-credits">
                                <h1>
                                    {{__('WARNING You have only 0 credits left')}}
                                <i class="fa fa-exclamation-triangle right"></i>
                                </h1>
                    </div>
                </div>
            @endif
        </div>
        <div class="col m12 l12 hide-on-small-only">
            <div class="news-dashboard">
                <div class="card-header" onclick="event.stopPropagation();">
                    <div class="select-wrapper dashboard-select graph-select">
                        <select class="dashboard-select graph-select initialized" data-select-id="227b884c-1520-9c96-2b26-c48bc58f5c38">
                            <option value="year">{{__('Files this year')}}</option>
                            <option value="month">{{__('Files this month')}}</option>
                            <option value="week">{{__('Files this week')}}</option>
                        </select>
                    </div>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                    <div class="year-chart chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="year-charts" height="696" width="1902" style="display: block; height: 348px; width: 951px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="month-chart chart-wrapper hide">
                        <canvas id="month-charts" height="696" width="1902" class="chartjs-render-monitor" style="display: block; height: 0px; width: 0px;"></canvas>
                    </div>
                    <div class="week-chart chart-wrapper hide">
                        <canvas id="week-charts" height="696" width="1902" class="chartjs-render-monitor" style="display: block; height: 0px; width: 0px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>{{__('Today')}}</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $todaysFilesCount }}  {{__('files')}}
                </span>
                    <span class="period">{{__('Yesterday')}}
                    <small>
                        {{ $yesterdaysFilesCount }} {{__('files')}}
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                    <span class="period">{{__('Previous year')}}
                    <small>
                        {{ $previousYearsFilesCount }}  {{__('files')}}
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>{{__('This week')}}</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $thisWeeksFilesCount }}  {{__('files')}}
                </span>
                    <span class="period">{{__('Previous week')}}
                    <small>
                        {{ $previousWeeksFilesCount  }}  {{__('files')}}
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                    <span class="period">{{__('Previous year')}}
                    <small>
                        {{ $previousYearsFilesCount }}  {{__('files')}}
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>{{__('This month')}}</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $thisMonthsFilesCount }} {{__('files')}}
                    <small>{{$thisWeeksCreditsCount}} Credits</small>
                </span>
                    <span class="period">{{__('Previous month')}}
                    <small>
                        {{ $previousMonthsFilesCount }}  {{__('files')}}
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                    <span class="period">{{__('Previous year')}}
                    <small>
                        {{ $previousYearsFilesCount }}  {{__('files')}}
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>{{__('This year')}}</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $thisYearsFilesCount }} {{__('files')}}
                    <small>{{ $thisYearsCreditsCount }}  Credits</small>
                </span>
                    <span class="period">{{__('Previous year')}}
                    <small>
                        {{ $previousYearsFilesCount }}  {{__('files')}}
                        <i class="fa fa-line-chart right"></i>
                    </small>
                </span>
                    <span class="period">{{__('Two years ago')}}
                    <small>
                        {{$twoYearsAgoFilesCount}}  {{__('files')}}
                        <i class="fa fa-line-chart right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>{{__('Last vehicles tuned')}}<i class="fa fa-clock-o right"></i></h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                    <table>
                        <tbody>
                            @foreach($twoFiles as $file)
                                <tr>
                                    <td>
                                        <img src="{{ $file->vehicle()->Brand_image_URL }}" alt=" logo" class="logo-id">
                                    </td>
                                    <td>
                                        <a class="car-info" href="{{route('file', $file->id)}}">
                                            {{$file->vehicle()->Name}} 
                                        </a>
                                        <span class="car-name">
                                            {{ $file->engine }} {{ $file->vehicle()->TORQUE_standard }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach                               
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        <div class="col s6 m3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>Modèle<i class="fa fa-fire right"></i></h1>
                </div>
                <div class="divider-light"></div>
                @if(!$twoFiles->isEmpty())
                    <div class="card-content height-table center">
                        <h1>{{$twoFiles[0]->brand}}</h1>
                        <h3>{{$twoFiles[0]->model}}</h3>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="col s6 m3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>Marque<i class="fa fa-fire right"></i></h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content height-table center">
                    @if(!$twoFiles->isEmpty())
                        <img class="responsive-img logo-brand-dashboard" src="{{$twoFiles[0]->vehicle()->Brand_image_URL}}">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row"></div>
</div>
</main>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">

    $( document ).ready(function(event) {

        $(document).on('change', '.graph-select', function(e){
            let value = $(this).val();

            if(value == 'month'){
                $('.year-chart').addClass('hide');
                $('.month-chart').removeClass('hide');
                $('.week-chart').addClass('hide');
            }
            else if(value == 'week'){
                $('.year-chart').addClass('hide');
                $('.month-chart').addClass('hide');
                $('.week-chart').removeClass('hide');
            }
            else if(value == 'year'){   
                $('.year-chart').removeClass('hide');
                $('.month-chart').addClass('hide');
                $('.week-chart').addClass('hide');
            }

        });

        var xValuesYears = ['January','Fabrury','Marck','April','May',
        'June','July','August','September','October', 'November', 'December'];

        let yearObj = @php echo $countYear @endphp;
        let dataYear = Object.values(yearObj);

        new Chart("year-charts", {
        type: "line",
        data: {
                labels: xValuesYears,
                datasets: [{
                label: 'Files',
                data: dataYear,
                borderColor: "grey",
                fill: true
                },
            ]
        },
        options: {
            legend: {display: true}
        }
        });

        let objMonths= @php echo $datesMonth @endphp;
        let xValuesMonths = Object.values(objMonths);

        let objMonthsCount = @php echo $datesMonthCount @endphp;
        let yMonthsCount = Object.values(objMonthsCount);

        console.log(yMonthsCount);

        new Chart("month-charts", {
        type: "line",
        data: {  
                labels: xValuesMonths,
                datasets: [{
                label: 'Files',
                data: yMonthsCount,
                borderColor: "grey",
                fill: true
                },
            ]
        },
        options: {
            legend: {display: true}
        }
        });

        let weekRangeObj = @php echo $weekRange @endphp;
        let xValuesWeek = Object.values(weekRangeObj);

        let objWeekCount = @php echo $weekCount @endphp;
        let yWeeksCount = Object.values(objWeekCount);

        // console.log(yMonthsCount);

        new Chart("week-charts", {
        type: "line",
        data: {
                labels: xValuesWeek,
                datasets: [{
                label: 'Files',
                data: yWeeksCount,
                borderColor: "grey",
                fill: true
                },
            ]
        },
        options: {
            legend: {display: true}
        }
        });
    });

</script>

@endsection