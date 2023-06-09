@extends('layouts.main')

@section('content')
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded p-2">
                    <h2 class="mb-3">Peminjaman</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <div class="col-lg-12">
            <div class="bg-light rounded border p-4 shadow-sm">
                <!-- Tables Start-->
                <table id="peminjamanTable" class="table-bordered table" style="width:100%">
                    <thead>
                        <tr class="fw-bold text-center">
                            <th style="width: 1%">No</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Jatuh Tempo</th>
                            <th>Buku</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->tgl_peminjaman }}</td>
                                <td>{{ $data->tgl_kembali }}</td>
                                <td>
                                    @foreach ($data->buku as $buku)
                                        <ul>{{ $buku->judul_buku }}</ul>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <i class="fa fa-check" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
                <!-- Tables End -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            table = $('#peminjamanTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('peminjaman.gettolak') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'tgl_peminjaman',
                            name: 'tgl_peminjaman'
                        },
                        {
                            data: 'tgl_kembali',
                            name: 'tgl_kembali'
                        },
                        {
                            data: 'buku',
                            name: 'buku'
                        },
                        {
                            data: 'alasan',
                            name: 'alasan'
                        },
                    ],
                    "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all"
                    }],
                },

            );
        })
    </script>
@endsection
