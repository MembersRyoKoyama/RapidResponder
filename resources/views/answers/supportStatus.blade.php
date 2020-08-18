@extends('layouts.app')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="{{ asset('js/chart.js') }}"></script>
@endpush

@section('content')
<script>
    window.Laravel = {};
    window.Laravel.pie = @json($pie);
    window.Laravel.bar = @json($bar);
</script>
<div class="container supportStatus">
    <h1 class="text-center">お問い合わせ対応状況</h1>
    <canvas id="pie"></canvas>
    <canvas id="bar"></canvas>
</div>
@endsection