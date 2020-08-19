@component('mail::message')
# お問い合わせありがとうございました
{{ $question->name }} 様<br>
お問い合わせありがとうございました。<br>
<br>



---
# お問い合わせ内容
@component('mail::panel')
{!! nl2br(e($question->content)) !!}
@endcomponent
@endcomponent