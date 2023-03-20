@extends('staff_gudang.sidebar')

@section('title', 'Detail barang')

@section('content-gudang')
<div class="bundling">
    <img src="{{ asset('images/barang_qrcode/' . $barang->qrcode_barang) }}" class="img-fluid" alt="...">
</div>
@endsection

@push ('styles')
<style scoped>
    .img-fluid {
        width: 600px;
        height: 600px;
        display: block;
        margin: 0 auto;
    }

    .bundling {
        margin-top: 100px;
    }
</style>
@endpush
