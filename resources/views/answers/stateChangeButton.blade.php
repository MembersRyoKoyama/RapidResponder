<a href="/questionStateChange?id={{$id}}&to={{$to}}">
  @switch($to)
  @case(1)
  未対応に戻す
  @break

  @case(2)
  対応開始
  @break

  @case(3)
  対応完了
  @break
  @endswitch
</a>