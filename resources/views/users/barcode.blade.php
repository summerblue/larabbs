@extends('layouts.app')

@section('title', '条形码')

@section('content')

<h3 class="text-center">一维条形码</h3>
<div class="row">
    @foreach($barcodeOf1d as $type => $barcode)

        <div class="col-md-3 text-center" style="min-height: 100px">
            <div><img src="data:image/png; base64, {{ $barcode }}"/></div>
            <div>{{ $type }}</div>
        </div>
    @endforeach
</div>

<h3 class="text-center">二维条形码</h3>
<div class="row">
    @foreach($barcodeOf2d as $type => $barcode)
        <div class="col-md-3 text-center" style="min-height: 200px">
            <div><img src="data:image/png; base64, {{ $barcode }}"/></div>
            <div>{{ $type }}</div>
        </div>
    @endforeach
</div>

@endsection