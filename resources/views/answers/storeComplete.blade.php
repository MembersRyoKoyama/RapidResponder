@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/storeComplete.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container text-center">
  <h1 class="text-center">送信完了</h1>
  <a href="/questionList">
    <x-button text="戻る" style="button-dark" />
  </a>
</div>
@endsection