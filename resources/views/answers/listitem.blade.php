<tbody>
  <tr class="d-flex">
    <td class="col-1" scope="row">
      @include('answers.endIcon',['end'=>$q->end])
    </td>
    <td class="col-1">{{$q->name}}</td>
    <td class="col-2">{{$q->tel}}</td>
    <td class="col-1">{{$q->products->name}}</td>
    <td class="col-2">{{$q->date}}</td>
    <td class="col-4">{{Str::substr($q->content,0,100)}}</td>
    <td class="col-1"><a href="/questionView?id={{$q->id}}">詳細</a></td>
  </tr>
</tbody>