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
                    <h2>Edit Identitas Sekolah</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Panel End -->

    <!-- Form Start -->
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <form action="{{ route('identitas.update', $identitas->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"> Image
                        </label>
                        <div class="input-group">
                            <img src="{{ asset('logo/') }}/{{ $identitas->logo }}" id="previewImg" class="img-thumbnail"
                                alt="...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Nama Sekolah</label>
                        <div class="input-group">
                            <input value="{{ $identitas->nama_sekolah }}" placeholder="Nama Sekolah" class="form-control"
                                name="nama_sekolah" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Nama Aplikasi</label>
                        <div class="input-group">
                            <input value="{{ $identitas->nama_aplikasi }}" placeholder="Nama Aplikasi" class="form-control"
                                name="nama_aplikasi" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Alamat</label>
                        <div class="input-group">
                            <input value="{{ $identitas->alamat }}" placeholder="Alamat" class="form-control" name="alamat"
                                required>
                        </div>
                    </div>

                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Tahun Ajaran</label>
                        <div class="input-group">
                            <input value="{{ $identitas->tahun_ajaran }}" placeholder="Tahun Ajaran" class="form-control"
                                name="tahun_ajaran" required>
                        </div>
                    </div>

                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"><span class="text-danger">*</span>
                            Denda Keterlambatan /hari</label>
                        <div class="input-group">
                            <input type='text' value="{{ $identitas->denda }}" placeholder="Denda" class="form-control"
                                name="denda" required>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="" class="fw-bold mb-1">LOGO</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="logo" onchange="preview(this)">
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
                    href="{{ route('identitas.index') }}">
                    Back</a>
            </button>
        </form>
    </div>
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
