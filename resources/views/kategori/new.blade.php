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
                    <h2 class="mb-2">Tambahkan Katagori</h2>
                </div>
                <!-- Panel End -->
                <!-- Form Start -->
                <div class="bg-light rounded border p-4">
                    <div class="row">
                        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-input mb-3">
                                        <label for="" class="fw-bold mb-1"> Nama</label>
                                        <div class="input-group">
                                            <input value="" placeholder="Nama" class="form-control"
                                                name="nama_kategori">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary fw-bold mt-3 px-4 py-2"><i
                                            class="fas fa-save"></i>
                                        <div class="d-none d-sm-inline"> Save</div>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary fw-bold mt-3 px-4 py-2"><i
                                            class="fas fa-caret-square-left"></i>
                                        <a class="text-secondary text-secondary-hover d-none d-sm-inline text-decoration-none"
                                            href="{{ route('kategori.index') }}">
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
