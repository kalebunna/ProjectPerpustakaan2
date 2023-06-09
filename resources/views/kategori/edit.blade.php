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
                    <h2>Edit kategori | {{ $kategori->nama }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" name="id" required autofocus value="{{ $kategori->id }}"
                readonly>
            <div class="row">
                <div class="col-lg-5">
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"> Nama</label>
                        <div class="input-group">
                            <input value="{{ $kategori->nama_kategori }}" placeholder="Nama" class="form-control"
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


    <!-- Content End -->
@endsection
