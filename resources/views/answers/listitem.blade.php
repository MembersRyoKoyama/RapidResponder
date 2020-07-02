<tbody>
  <td>
    @include('answers.endIcon',['end'=>$q->end])
  </td>
  <td>{{$q->name}}</td>
  <td>{{$q->tel}}</td>
  <td>{{$q->products->name}}</td>
  <td>{{$q->date}}</td>
  <td>{{Str::substr($q->content,0,100)}}</td>
  <td><a href="#">詳細</a></td>
</tbody>
