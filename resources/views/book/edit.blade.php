@extends('layouts.main')

@section('content')
    <!-- Panel Start -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded p-2">
                    <h2>Edit Buku | {{ $buku->judul_buku }} - {{ $buku->pengarang }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Panel End -->

    <!-- Form Start -->
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"> Image
                        </label>
                        <div class="input-group">
                            <img src="{{ asset('images/') }}/{{ $buku->gambar }}" id="previewImg" class="img-thumbnail"
                                alt="...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="form-input mb-3">
                        <select class="form-control" id="kategori_id" name="kategori_id">
                            <label for="" class="fw-bold mb-1"> Kategori</label>
                            @foreach ($kategori as $data)
                                @if (old('rak_id', $buku->kategori_id) == $data->id)
                                    <option value="{{ $data->id }}" selected>{{ $data->nama_kategori }}
                                    </option>
                                @else
                                    <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Judul</label>
                        <div class="input-group">
                            <input value="{{ $buku->judul_buku }}" placeholder="Judul" class="form-control"
                                name="judul_buku" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Pengarang</label>
                        <div class="input-group">
                            <input value="{{ $buku->pengarang }}" placeholder="Pengarang" class="form-control"
                                name="pengarang" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Peberbit</label>
                        <div class="input-group">
                            <input value="{{ $buku->penerbit }}" placeholder="Penerbit" class="form-control"
                                name="penerbit" required>
                        </div>
                    </div>

                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Tahun Terbit</label>
                        <div class="input-group">
                            <input value="{{ $buku->tahun_terbit }}" placeholder="Tahun Terbit" class="form-control"
                                name="tahun_terbit" required>
                        </div>
                    </div>

                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            jumlah_halaman</label>
                        <div class="input-group">
                            <input type='text' value="{{ $buku->jumlah_halaman }}" placeholder="Jumlah Halaman"
                                class="form-control" name="jumlah_halaman" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            stok_buku</label>
                        <div class="input-group">
                            <input type='number' value="{{ $buku->stok_buku }}" placeholder="Stok" class="form-control"
                                name="stok_buku" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            sinopsis</label>
                        <div class="input-group">
                            <textarea type='text' value="" placeholder="Sinopsis" class="form-control" name="sinopsis" required>
                            {{ $buku->sinopsis }}
                            </textarea>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            label</label>
                        <div class="input-group">
                            <input type='text' value="{{ $buku->label_buku }}" placeholder="Label Buku"
                                class="form-control" name="label_buku" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Bahasa</label>
                        <div class="input-group">
                            <input type='text' value="{{ $buku->bahasa }}" placeholder="Bahasa" class="form-control"
                                name="bahasa" required>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="fw-bold mb-1"> Image
                        </label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="gambar" onchange="preview(this)">
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-outline-primary fw-bold mt-3 px-4 py-2"><i class="fas fa-save"></i>
                <div class="d-none d-sm-inline"> Save</div>
            </button>
            <button type="button" class="btn btn-outline-secondary fw-bold mt-3 px-4 py-2"><i
                    class="fas fa-caret-square-left"></i>
                <a class="text-secondary text-secondary-hover d-none d-sm-inline text-decoration-none"
                    href="{{ route('buku.index') }}">
                    Back</a>
            </button>
        </form>
    </div>
    <!-- Form End -->

    <!-- Content End -->

    <script>
        function preview(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $('#previewImg').attr('src', reader.result)
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
