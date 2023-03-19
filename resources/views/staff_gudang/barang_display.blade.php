@extends('staff_gudang.sidebar')

@section('title', 'Create barang')

@section('content-gudang')
<div class="bundling">
    <div class="row row-cols-1 row-cols-md-5 g-4">
        @foreach ($data as $barang)
        <div class="col">
            <div class="card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png" class="card-img-top" alt="...">
                <div class="card-header">
                    Cakue
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
                    <a href="#" class="card-link btn btn-primary">Edit</a>
                    <a href="#" class="card-link btn btn-danger">Delete</a>
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
</style>
@endpush