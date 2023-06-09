@extends('layouts.main')

@section('content')
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded p-2">
                    <h2 class="mb-3">Buku</h2>
                    <div class="row mb-2">
                        <div class="col-sm">
                            {{-- @if (auth()->user()->role === 'admin') --}}
                            <a href="{{ route('buku.create') }}" class="text-decoration-none text-white">
                                <button class="btn btn-outline-primary fw-bold px-4 py-2"><i class="fas fa-plus"></i>
                                    <div class="d-none d-sm-inline"> New
                                </button>
                            </a>
                            {{-- @endif --}}
                            <a href="
                            {{-- {{ route('book.export') }} --}}
                            "
                                class="text-decoration-none">
                                <button class="btn btn-outline-success fw-bold px-4 py-2"><i class="fas fa-file-excel"></i>
                                    <div class="d-none d-sm-inline">Export to Excel
                                </button>
                            </a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="col-lg-12">
            <div class="bg-light rounded border p-4 shadow-sm">
                <!-- Tables Start-->
                <table id="datatable" class="table-bordered table" style="width:100%">
                    <thead>
                        <tr class="fw-bold text-center">
                            <th style="width: 1%">No</th>
                            <th style="width: 7%">Gambar Buku</th>
                            <th>Judul</th>
                            <th>kategori</th>
                            <th>Penulis</th>
                            <th>penerbit</th>
                            <th style="width: 5%">Stok</th>
                            <th class="sorting_none" style="width: 18%">aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @foreach ($bukus as $book)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="justify-content-center"><img src="{{ asset('images') }}/{{ $book->gambar }}"
                                        alt="{{ $book->gambar }}" width="70rem"></td>
                                <td>{{ $book->judul_buku }}</td>
                                <td>{{ $book->kategori->nama_kategori }}</td>
                                <td>{{ $book->pengarang }}</td>
                                <td>{{ $book->penerbit }}</td>
                                <td class="text-center">{{ $book->stok_buku }}</td>
                                <td class="text-center">
                                    <a href="{{ route('buku.show', $book->id) }}"
                                        class="text-decoration-none ms-2 me-2 py-1 text-center">
                                        View </a>
                                    {{-- @if (auth()->user()->role === 'admin') --}}
                                    <a href="{{ route('buku.edit', $book->id) }}"
                                        class="text-decoration-none ms-2 me-2 py-1 text-center">
                                        Edit </a>
                                    <button data-toggle="modal" data-target="#deleteModal"
                                        data-attr="{{ route('buku.destroy', $book->id) }}"
                                        data-nama_buku="{{ $book->judul_buku }}"
                                        class="bg-light text-danger text-decoration-none ms-2 me-2 border-0 py-1 text-center"
                                        onclick="change_data_in_modal(this)">
                                        Delete </button>
                                    {{-- @endif --}}
                                </td>
                            </tr>
                        @endforeach
                </table>
                <!-- Tables End -->
            </div>
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
                    Menghapus <i id="modal_nama_buku"></i>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="form-delete">
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

    <script>
        function change_data_in_modal(e) {
            $("#modal_nama_buku").html($(e).data("nama_buku"));
            $("#form-delete").attr("action", $(e).data("attr"))
        }
    </script>
@endsection
