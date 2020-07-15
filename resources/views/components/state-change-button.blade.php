@pushonce('styles')
<link href="{{ asset('css/stateChangeButton.css') }}" rel="stylesheet">
@endpushonce

@switch($to)
@case(1)
@if($question->staffs_id==Auth::id())
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
    <x-button text="未対応に戻す" style="button-dark" />
</a>
@else
<span>未対応に戻す</span>
@endif
@break

@case(2)
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
    <x-button text="対応開始" style="button-dark" />
</a>
@break

@case(3)
@if($question->staffs_id==Auth::id())
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
    <x-button text="対応完了" style="button-dark" />
</a>
@else
<span>対応完了</span>
@endif
@break
@endswitch