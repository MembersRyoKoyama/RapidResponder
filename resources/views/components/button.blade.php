@pushonce('styles')
<link href="{{ asset('css/button.css') }}" rel="stylesheet">
@endpushonce

<span class="{{$style??'button'}}">
    {{$text}}
</span>