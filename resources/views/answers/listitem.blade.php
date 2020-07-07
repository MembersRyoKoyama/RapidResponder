<tbody>
  <tr class="d-flex">
    <td class="col-1" scope="row">
      @include('answers.endIcon',['end'=>$q->end])<br>
      @if($q->end!=1)
      {{$question->users==null?'名無し':$question->users->name}}
      @endif
    </td>
    <td class="col-1">{{$q->name}}</td>
    <td class="col-2">{{$q->tel}}</td>
    <td class="col-1">{{$q->products->name}}</td>
    <td class="col-2">{{$q->date}}</td>
    <td class="col-4">{{Str::substr($q->content,0,100)}}</td>
    <td class="col-1"><a href="/questionView?id={{$q->id}}">詳細</a></td>
  </tr>
</tbody>