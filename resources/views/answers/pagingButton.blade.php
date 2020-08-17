@pushonce('styles')
<link href="{{ asset('css/pagingButton.css') }}" rel="stylesheet">
@endpushonce

<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <!--
   @if($now!=1)
    <li class="page-item"><a class="page-link" href="{{url()->current().'?'.http_build_query(['end'=>$end,'p'=>($now-1)])}}">Prev</a></li>
   @endif
  -->
    @foreach($pages as $page)
    <li class="pagingButton">
      <a class="" href="{{url()->current().'?'.http_build_query(['end'=>$end,'p'=>($page)])}}">
        <x-button :text='$page' style="{{$now==$page?'button-outline-active':'button-outline'}}" />
      </a>
    </li>
    @endforeach
    <!--
   @if($now!=1)
    <li class="page-item"><a class="page-link" href="{{url()->current().'?'.http_build_query(['end'=>$end,'p'=>($now+1)])}}">Next</a></li>
   @endif
  -->
  </ul>
</nav>