<tbody>
  <td>
    @switch($q->end)
      @case(1)
        <span class="end1">未対応</span>
        @break
      @case(2)
        <span class="end2">対応中</span>
        @break
      @case(3)
        <span class="end3">対応済</span>
        @break
    @endswitch
    
  </td>
  <td>{{$q->name}}</td>
  <td>{{$q->tel}}</td>
  <td>{{$q->products_id}}</td>
  <td>{{$q->date}}</td>
  <td>{{$q->content}}</td>
  <td>詳細</td>
</tbody>
