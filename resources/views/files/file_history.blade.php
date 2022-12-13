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
                            <th class="hide-on-small-and-down">Credits</th>
                            <th class="hide-on-small-and-down">VIN</th>
                            <th>Customer</th>
                            <th>Plate</th>
                            <th class="hide-on-small-and-down"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)

                        <tr class="redirect-click @if($file->checked_by == 'engineer') checked @endif" href="#" data-redirect="{{route('file', $file->id)}}">
                            <td class="clickable-row">

                                <img alt="" class="img-circle-car-history" src="{{ get_image_from_brand($file->brand) }}">

                                <span class="brand-name">{{$file->brand}}</span>
                            </td>
                            <td class="clickable-row">
                                {{$file->vehicle()->Name}} {{ $file->engine }} {{ $file->vehicle()->TORQUE_standard }}
                            </td>
                            <td class="clickable-row">
                                <span class="label @if($file->status == 'submitted') label-blue @elseif($file->status == 'completed') label-green @else label-red @endif">{{$file->status}}<i class="fa @if( $file->status == 'accepted') fa-check @elseif($file->status == 'rejected') fa-close @endif "></i></span></a>
                            </td>
                            <td class="clickable-row"><span class="label label-black">{{$file->credits}}</span></td>
                            <td class="clickable-row"><input class="vehicle-id-input" id="125091" value="{{$file->vin_number}}" readonly="" onclick="copyVin(125091)"></td>
                            <td class="clickable-row">{{$file->name}}</td>
                            <td class="clickable-row">{{$file->license_plate}}</td>
                            <td class="clickable-row">{{$file->created_at->diffForHumans();}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">
    $(document).ready(function(event) {
        $('.redirect-click').click(function() {
            window.location.href = $(this).data('redirect');
            return false;
        });

        $('table').DataTable({
            "ordering": false,
        });
    });

</script>

@endsection
