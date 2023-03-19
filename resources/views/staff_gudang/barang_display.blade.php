@extends('staff_gudang.sidebar')

@section('title', 'Create barang')

@section('content-gudang')
<div class="bundling">
    <div class="row row-cols-1 row-cols-md-5 g-4">
        @foreach ($data as $barang)
        <div class="col">
            <div class="card bg-light card-container">
                <img src="{{ asset('images/barang/' . $barang->gambar_barang) }}" class="card-img-top" alt="...">
                <div class="card-header">
                    {{$barang->nama_barang}}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h5>Kode :
                            <span class="badge bg-secondary">{{$barang->kode_barang}}</span>
                        </h5>
                    </li>
                    <li class="list-group-item">
                        <h5>Stok :
                            <span class="badge bg-secondary">{{$barang->stok_barang}}</span>
                        </h5>
                    </li>
                    <li class="list-group-item">
                        <h5>Harga :
                            <span class="badge bg-secondary">Rp{{$barang->harga_barang}}</span>
                        </h5>
                    </li>
                </ul>
                <div class="card-footer">
                    <a href="{{ route('gudang.barang_edit', ['id' => $barang->id]) }}" class="card-link btn btn-primary">Edit</a>
                    <a href="{{ route('gudang.barang_delete', ['id' => $barang->id]) }}" class="card-link btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push ('styles')
<style scoped>
    .bundling {
        margin-top: 25px;
    }

    .card-header {
        font-weight: 600;
        font-size: 18px;
        justify-content: center;
        background-color: #bad4f7;
    }

    .card-footer {
        justify-content: right;
    }

    .card-footer a {
        font-size: 14px;
    }

    .card-img-top {
        width: 100%;
        height: 225px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-container {
        border-radius: 15px;
    }
</style>
@endpush