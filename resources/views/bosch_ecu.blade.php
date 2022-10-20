@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1 class="h1-olsx-history">
            Bosch ECU Numbers
        </h1>
        <div class="table-history-panel center">
            <div class="bosch-ecu-result row">
            </div>
            <div class="row">
                <div class="col s12">
                    <label class="sr-only active">Search a car...</label>
                    <input class="form-control number-ecu" placeholder="Enter a Bosch ECU number" type="text" autofocus="">
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <label class="sr-only">Search a car...</label>
                    <button class="btn btn-red search-button">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
