@pushonce('styles')
<link href="{{ asset('css/endIcon.css') }}" rel="stylesheet">
@endpushonce

@switch($end)
@case(1)
<span class="endIcon end1">未対応</span>
@break
@case(2)
<span class="endIcon end2">対応中</span>
@break
@case(3)
<span class="endIcon end3">対応済</span>
@break
@endswitch