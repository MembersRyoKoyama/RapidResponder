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
    <td class="col-4">
        <div>{{Str::substr($question->content,0,100)}}</div>
        <div>
            @foreach($question->tags as $tag)
            <span class="tag">{{$tag->name}}</span>
            @endforeach
        </div>
    </td>
    <td class="col-1">
        <span class="detail-button">
            <a href="/questionView?id={{$question->id}}">
                <x-button text="詳細" />
            </a>
        </span>
    </td>
</tr>