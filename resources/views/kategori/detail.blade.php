@extends('layouts.main')

@section('content')
    <!-- Panel Start -->
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded p-2">
                    <h2 class="mb-3">Detail kategori</h2>
                    <div class="row mb-2">
                        <div class="col-sm">
                            <a href="/kategori/{{ $kategori->id }}/edit" class="text-decoration-none text-white">
                                <button class="btn btn-outline-primary fw-bold px-4 py-2"><i class="fas fa-edit"></i>
                                    <div class="d-none d-sm-inline"> Edit</div>
                                </button>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-danger fw-bold px-4 py-2" data-toggle="modal"
                                data-target="#deleteModal">
                                <i class="fas fa-trash"></i>
                                <div class="d-none d-sm-inline"> Delete</div>
                            </button>
                            <button type="button" class="btn btn-outline-secondary fw-bold px-4 py-2"><i
                                    class="fas fa-caret-square-left"></i>
                                <a class="text-secondary text-secondary-hover d-none d-sm-inline text-decoration-none"
                                    href="{{ route('kategori.index') }}">
                                    Back</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Panel End -->

    <!-- Form Start -->
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-input mb-3">
                            <label for="" class="fw-bold mb-1"> ID</label>
                            <div class="input-group">
                                <input value="{{ $kategori->id }}" placeholder="id" class="form-control" name="id"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-input mb-3">
                            <label for="" class="fw-bold mb-1"> Nama Kategori</label>
                            <div class="input-group">
                                <input value="{{ $kategori->nama_kategori }}" placeholder="NIS" class="form-control"
                                    name="nis" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Form End -->
    </div>
    </div>

    {{-- Modal Start --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-exclamation-circle text-warning"></i> Apakah Anda Yakin Akan
                    Menghapus {{ $kategori->nama_kategori }}
                </div>
                <div class="modal-footer">
                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-outline-secondary px-3 py-1"
                            data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-outline-danger px-3 py-1">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal End --}}
@endsection
