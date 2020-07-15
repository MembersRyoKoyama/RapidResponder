@switch($to)
@case(1)
@if($question->staffs_id==Auth::id())
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
  <span class="btn">未対応に戻す</span>
</a>
@else
<span class="btn">未対応に戻す</span>
@endif
@break

@case(2)
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
  <span class="btn">対応開始</span>
</a>
@break

@case(3)
@if($question->staffs_id==Auth::id())
<a href="/questionStateChange?id={{$question->id}}&to={{$to}}">
  <span class="btn">対応完了</span>
</a>
@else
<span class="btn">対応完了</span>
@endif
@break
@endswitch