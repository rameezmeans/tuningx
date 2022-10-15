@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
    <div class="container">
        <h1 class="h1-olsx-history">Edit Language</h1>
        <div class="table-history-panel">
            <p>Edit Mastery of Language by clicking on it.</p>
            <form method="POST" action="{{ route('update-language'); }}" style="margin-bottom: 20px;">
                @csrf
                <input type="hidden" value="{{$language->id}}" name="id">
                <label for="language">Lanugae :</label>
                <input name="language" type="text" value="{{$language->language}}" readonly>
                <label for="mastery_level">Mastery :</label>
                <div class="level-container">
                    <input type="hidden" id="mastery" name="mastery" value="{{$language->mastery}}">
                    @for ($i = 1; $i <= 5; $i++)
                        @if($i <= $language->mastery )
                            <i class="fa level-star star-nb-1 fa-star" data-level="{{$i}}"></i>
                        @else
                            <i class="fa level-star star-nb-4 fa-star-o" data-level="{{$i}}"></i>
                        @endif
                    @endfor
                </div>
                <button type="submit" class="btn btn-success" style="margin-top: 20px;">Upadte</button>
            </form>
        </div>
    </div>
</main>
@endsection

@section('pagespecificscripts')

<script type="text/javascript">
    $( document ).ready(function(event) {
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
            $('#mastery').val(level);
        });
    });
</script>
@endsection