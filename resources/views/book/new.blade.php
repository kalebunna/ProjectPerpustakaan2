@extends('layouts.main')

@section('content')
    <!-- Panel Start -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif
    <div class="bg-light mb-4 rounded border p-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light mb-4 p-2">
                    <h2 class="mb-2">Tambahkan Buku</h2>
                </div>
                <!-- Panel End -->
                <!-- Form Start -->
                <div class="bg-light rounded border p-4">
                    <div class="row">
                        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"> Image
                                        </label>
                                        <div class="input-group">
                                            <img src="" id="previewImg" class="img-thumbnail" alt="...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            Kategori</label>
                                        <div class="input-group">
                                            <select class="form-control" id="kategori" name="kategori_id">
                                                @foreach ($kategoris as $kategori)
                                                    @if (old('kategori_id') == $kategori->id)
                                                        <option class="option" value="{{ $kategori->id }}" selected>
                                                            {{ $kategori->nama_kategori }}
                                                        </option>
                                                    @else
                                                        <option class="option" value="{{ $kategori->id }}">
                                                            {{ $kategori->nama_kategori }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            Judul</label>
                                        <div class="input-group">
                                            <input value="" placeholder="Judul" class="form-control" name="judul_buku"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            Pengarang</label>
                                        <div class="input-group">
                                            <input value="" placeholder="Pengarang" class="form-control"
                                                name="pengarang" required>
                                        </div>
                                    </div>
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            Peberbit</label>
                                        <div class="input-group">
                                            <input value="" placeholder="Penerbit" class="form-control"
                                                name="penerbit" required>
                                        </div>
                                    </div>

                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            Tahun Terbit</label>
                                        <div class="input-group">
                                            <input value="" placeholder="Tahun Terbit" class="form-control"
                                                name="tahun_terbit" required>
                                        </div>
                                    </div>

                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            jumlah_halaman</label>
                                        <div class="input-group">
                                            <input type='text' value="" placeholder="Jumlah Halaman"
                                                class="form-control" name="jumlah_halaman" required>
                                        </div>
                                    </div>
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            stok_buku</label>
                                        <div class="input-group">
                                            <input type='number' value="" placeholder="Stok" class="form-control"
                                                name="stok_buku" required>
                                        </div>
                                    </div>
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            sinopsis</label>
                                        <div class="input-group">
                                            <textarea type='text' value="" placeholder="Sinopsis" class="form-control" name="sinopsis" required>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            label</label>
                                        <div class="input-group">
                                            <input type='text' value="" placeholder="Label Buku"
                                                class="form-control" name="label_buku" required>
                                        </div>
                                    </div>
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                                            Bahasa</label>
                                        <div class="input-group">
                                            <input type='text' value="" placeholder="Bahasa"
                                                class="form-control" name="bahasa" required>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="" class="fw-bold mb-1"> Image
                                        </label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="gambar"
                                                onchange="preview(this)">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary fw-bold mt-3 px-4 py-2"><i
                                            class="fas fa-plus"></i>
                                        <div class="d-none d-sm-inline"> Tambahkan</div>
                                    </button>
                                    <button type="reset" class="btn btn-outline-danger fw-bold mt-3 px-4 py-2"
                                        value="reset"><i class="fas fa-undo"></i>
                                        <div class="d-none d-sm-inline"> Reset</div>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary fw-bold mt-3 px-4 py-2"><i
                                            class="fas fa-caret-square-left"></i>
                                        <a class="text-secondary text-secondary-hover d-none d-sm-inline text-decoration-none"
                                            href="{{ route('buku.index') }}">
                                            Back</a>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Form End -->
                </div>
            </div>
        </div>
    </div>
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
