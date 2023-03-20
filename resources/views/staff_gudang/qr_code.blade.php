@extends('staff_gudang.sidebar')

@section('title', 'Generate QR Code')

@section('content-gudang')
<form action="{{ route('gudang.qrcode_generate.submit') }}" method="post">
    @csrf
    <input type="text" name="content" placeholder="Enter content">
    <button type="submit">Generate</button>
</form>
@endsection
