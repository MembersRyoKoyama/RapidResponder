@switch($to)
@case(1)
@if($question->staffs_id==Auth::id())
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
  未対応に戻す
</a>
@else
<span>未対応に戻す</span>
@endif
@break

@case(2)
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
  対応開始
</a>
@break

@case(3)
@if($question->staffs_id==Auth::id())
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
  対応完了
</a>
@else
<span>対応完了</span>
@endif
@break
@endswitch