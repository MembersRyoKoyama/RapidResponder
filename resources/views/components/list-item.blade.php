@pushonce('styles')
<link href="{{ asset('css/listItem.css') }}" rel="stylesheet">
@endpushonce

<tr class="d-flex listItem">
    <td class="col-1" scope="row">


        <x-end-icon end="{{$question->end}}" />

        @if($question->end!=1)
        <p>{{
            $question->users==null?'名無し':$question->users->name
        }}</p>
        @endif
    </td>
    <td class="col-1"><span>{{$question->name}}</span></td>
    <td class="col-2"><span>{{$question->tel}}</span></td>
    <td class="col-1"><span>{{$question->products->name}}</span></td>
    <td class="col-2"><span>{{$question->date}}</span></td>
    <td class="col-4"><span>{{Str::substr($question->content,0,100)}}</span></td>
    <td class="col-1">
        <span>
            <a href="/questionView?id={{$question->id}}">
                <x-button text="詳細" />
            </a>
        </span>
    </td>
</tr>