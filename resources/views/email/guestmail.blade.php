@component('mail::message')
{{ $question->name }} 様<br>
@component('mail::panel')
製品種別:{{$question->products->name}}<br>
お問い合わせ内容<br>
{!! nl2br(e($question->content)) !!}
@endcomponent
<br>
以上の内容でお問い合わせを受けました。<br>
ご利用ありがとうございました。<br>
スタッフからの対応をお待ちください。<br>
@endcomponent