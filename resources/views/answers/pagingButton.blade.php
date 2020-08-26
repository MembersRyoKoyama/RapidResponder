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
    @php
    $pageSize=2;
    @endphp
    @foreach($pages as $page)
    @if($page==1||$page==count($pages)||abs($page-$now)<$pageSize) <li class="pagingButton">
      <a class="" href="{{url()->current().'?'.http_build_query(['end'=>$end,'p'=>($page),'tagids'=>implode(',',$selectedTags)])}}">
        <x-button :text='$page' style="{{$now==$page?'button-outline-active':'button-outline'}}" />
      </a>
      </li>
      @elseif(abs($page-$now)==$pageSize)
      <span class="dot">・・・</span>
      @endif
      @endforeach
      <!--
   @if($now!=1)
    <li class="page-item"><a class="page-link" href="{{url()->current().'?'.http_build_query(['end'=>$end,'p'=>($now+1)])}}">Next</a></li>
   @endif
  -->
  </ul>
</nav>