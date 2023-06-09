@extends('layouts.main')

@section('content')
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded p-2">
                    <h2 class="mb-3">member</h2>
                    <div class="row mb-2">
                        <div class="col-sm">
                            <a href="{{ route('member.create') }}" class="text-decoration-none text-white">
                                <button class="btn btn-outline-primary fw-bold px-4 py-2"><i class="fas fa-plus"></i>
                                    <div class="d-none d-sm-inline"> New
                                </button>
                            </a>
                            {{-- <a href="{{ route('siswa.export') }}" class="text-decoration-none">
                                <button class="btn btn-outline-success fw-bold px-4 py-2"><i class="fas fa-file-excel"></i>
                                    <div class="d-none d-sm-inline">Export to Excel
                                </button>
                            </a> --}}

                            {{-- <a href="{{ route('audit') }}" class="text-decoration-none text-white">
                                <button class="btn btn-outline-secondary fw-bold px-4 py-2"><i class="fas fa-history"></i>
                                    <div class="d-none d-sm-inline">Log Audit
                                </button>
                            </a> --}}
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
                            <th>Nama</th>
                            <th>Nis</th>
                            <th>Telpon</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th class="sorting_none" style="width: 18%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->profile->nim }}</td>
                                <td>{{ $data->profile->no_telp }}</td>
                                <td>{{ $data->profile->alamat }}</td>
                                <td>
                                    @if ($data->profile->kelamin == 'L')
                                        Laki-Laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                {{-- <td>Rp. {{ number_format($dat«->denda, 0, '.', '.') }}</td> --}}
                                <td class="text-center">
                                    <a href="{{ route('member.show', $data->id) }}"
                                        class="text-decoration-none ms-2 me-2 py-1 text-center">
                                        View </a>
                                    <a href="{{ route('member.edit', $data->id) }}"
                                        class="text-decoration-none ms-2 me-2 py-1 text-center">
                                        Edit </a>
                                    <button data-toggle="modal" data-target="#deleteModal"
                                        data-attr="{{ route('member.destroy', $data->id) }}"
                                        data-nama_siswa="{{ $data->name }}"
                                        class="bg-light text-danger text-decoration-none ms-2 me-2 border-0 py-1 text-center"
                                        onclick="change_data_in_modal(this)">
                                        Delete
                                    </button>
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
                    Menghapus <i id="modal_nama_siswa"></i>
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
            console.log($(e).data("nama_siswa"));
            $("#modal_nama_siswa").html($(e).data("nama_siswa"));
            $("#form-delete").attr("action", $(e).data("attr"))
        }
    </script>
@endsection
