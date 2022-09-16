@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1 class="h1-olsx-history">File History</h1>
        <div class="table-history-panel">
            <div class="row">
                <table class="olsx-history file-history highlight">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Vehicle</th>
                            <th>Status</th>
                            <th class="hide-on-small-and-down">Credits</th>                                                                     <th class="hide-on-small-and-down">VIN</th>
                            <th>Customer</th>
                            <th>Plate</th>
                            <th class="hide-on-small-and-down"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        
                            <tr>
                                <td class="clickable-row">
                                    <a href="{{route('file', $file->id)}}">
                                    <img alt="" class="img-circle-car-history" src="https://www.shiftech.eu/media/resized/100x100/manufacturers/5f98ae3c7c4f9f03b4033f72a4d20dd6.png">
                                </a>
                                    <span class="brand-name">Mercedes</span>
                                </td>
                                <td class="clickable-row"><a href="{{route('file', $file->id)}}">{{$file->file_attached}}</a></td>
                                <td class="clickable-row">
                                    <a href="{{route('file', $file->id)}}"><span class="label label-green">Received<i class="fa fa-check"></i></span></a>
                                </td>
                                <td class="clickable-row"><a href="{{route('file', $file->id)}}"><span class="label label-black">9</span></a></td>
                                <td class="clickable-row"><a href="{{route('file', $file->id)}}"><input class="vehicle-id-input" id="125091" value="{{$file->vin_number}}" readonly="" onclick="copyVin(125091)"></a></td>
                                <td class="clickable-row"><a href="{{route('file', $file->id)}}">{{$file->name}}</a></td>
                                <td class="clickable-row"><a href="{{route('file', $file->id)}}">{{$file->license_plate}}</a></td>
                                <td class="clickable-row"><a href="{{route('file', $file->id)}}">{{$file->created_at->diffForHumans();}}</a></td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection