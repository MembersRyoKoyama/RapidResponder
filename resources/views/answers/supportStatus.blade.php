@extends('layouts.app')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="{{ asset('js/chart.js') }}"></script>
@endpush
@push('styles')
<link href="{{ asset('css/supportStatus.css') }}" rel="stylesheet">
@endpush

@section('content')
<script>
    window.Laravel = {};
    window.Laravel.pie = @json($pie);
    window.Laravel.bar = @json($bar);
</script>
<div class="container supportStatus">
    <h1 class="text-center">お問い合わせ対応状況</h1>
    <div class="pie">
        <h3 class="text-center">全お問い合わせ状況</h3>
        <canvas id="pie"></canvas>
        <div class="legend">
            {{$data['all']}}件中
            @for($i=1;$i<=3;++$i) <span class="end">
                <x-end-icon end="{{$i}}" />
                {{$data['end'][$i]}}件
                </span>
                @endfor
        </div>
    </div>
    <div class="bar">
        <h3 class="text-center">月別のお問い合わせ状況</h3>
        <canvas id="bar"></canvas>
        <div class="legend noBorder">
            @for($i=1;$i<=3;++$i) <span class="end">
                <x-end-icon end="{{$i}}" />
                </span>
                @endfor
        </div>
    </div>
</div>
@endsection