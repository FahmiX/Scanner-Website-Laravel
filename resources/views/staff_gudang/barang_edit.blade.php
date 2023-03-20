@extends('staff_gudang.sidebar')

@section('title', 'Edit barang')

@section('content-gudang')
<div class="container create-container">
    <form action="{{route('gudang.barang_update', $barang->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$barang->id}}">

        @if (session('error_message'))
        <div class="alert alert-danger" role="alert">
            {{session('error_message')}}
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card bg-light border-3 border-info table-card">
                    <div class="card-header">
                        Edit Barang
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" value="{{old('kode_barang', $barang->kode_barang)}}" autofocus>
                            @error('kode_barang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{old('nama_barang', $barang->nama_barang)}}">
                            @error('nama_barang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Barang</label>
                            <input type="text" id="deskripsi_barang" class="form-control @error('deskripsi_barang') is-invalid @enderror" name="deskripsi_barang" value="{{old('deskripsi_barang', $barang->deskripsi_barang)}}">
                            @error('deskripsi_barang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Stok Barang</label>
                            <input type="number" class="form-control @error('stok_barang') is-invalid @enderror" name="stok_barang" value="{{old('stok_barang', $barang->stok_barang)}}">
                            @error('stok_barang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Harga Barang</label>
                            <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" name="harga_barang" value="{{old('harga_barang', $barang->harga_barang)}}">
                            @error('harga_barang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Gambar Barang</label>
                            <input type="file" class="form-control @error('gambar_barang') is-invalid @enderror" name="gambar_barang" id="gambar_barang">
                            @error('gambar_barang') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="col-md-12 mb-2">
                            <img id="preview-image-before-upload" src="{{isset($barang) ? asset('images/barang/' . $barang->gambar_barang) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Antu_insert-image.svg/1200px-Antu_insert-image.svg.png'}}" alt="preview image" class="image-preview">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('gudang.barang_display')}}" class="btn btn-warning ms-3">
                        Batal
                    </a>
                </div>
            </div>
        </div>
</div>
</form>
</div>
@endsection

<style>
    .create-container {
        padding-top: 40px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-control {
        border-radius: 0px;
    }

    .card-header {
        font-weight: 600;
        font-size: 20px;
        justify-content: center;
        color: blue;
    }

    .card-footer {
        margin-bottom: 10px !important;
    }

    .image-preview {
        width: 200px;
        height: 200px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
</style>

@push('scripts')
<script>
    $(document).ready(function(e) {
        $('#gambar_barang').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endpush
