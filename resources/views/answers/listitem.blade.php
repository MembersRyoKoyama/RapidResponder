<tbody>
  <td>
    @include('answers.endIcon',['end'=>$q->end])
    @if($q->end!=1)
    {{$q->staffs->name??'名無し'}}
    @endif
  </td>
  <td>{{$q->name}}</td>
  <td>{{$q->tel}}</td>
  <td>{{$q->products->name}}</td>
  <td>{{$q->date}}</td>
  <td>{{Str::substr($q->content,0,100)}}</td>
  <td><a href="#">詳細</a></td>
</tbody>