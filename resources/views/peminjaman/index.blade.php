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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- Tables End -->
            </div>
        </div>
    </div>


    {{-- Modal Terima --}}
    <div class="modal fade" id="modalTerima" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-terima">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" name="id-terima" id="id-terima">
                        <i class="fas fa-exclamation-circle text-warning"></i> Apakah Anda Yakin Akan Menerima Peminjaman
                        Dari
                        <i id="namaPeminjam"></i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-outline-secondary px-3 py-1"
                            data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-outline-danger px-3 py-1">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal End --}}


    {{-- Modal Tolak --}}
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-tolak">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" name="id-tolak" id="id-tolak">
                        <i class="fas fa-exclamation-circle text-warning"></i> Apakah Anda Yakin Akan Menolak Peminjaman
                        Dari
                        <i id="namaPeminjamTolak"></i>
                        <input type="text" value="" name="alasan" id="alasan" class="form-control mt-3"
                            required placeholder="Masukkan Alasan">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-outline-secondary px-3 py-1"
                            data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-outline-danger px-3 py-1">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal End --}}
@endsection
@section('script')
    <script>
        var table;
        $(function() {

            table = $('#peminjamanTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('peminjaman.pending') }}",
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
                            data: 'action',
                            name: 'action',
                            className: "text-center",
                            orderable: true,
                            searchable: true
                        },
                    ],
                    "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all"
                    }],
                },

            );
        })

        function updateTerima(e) {
            $("#id-terima").val($(e).data("id"))
            $("#namaPeminjam").html($(e).data("nama"));
        }

        $("#form-terima").submit(function(event) {
            var formData = {
                id: $("#id-terima").val(),
            };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "{{ route('peminjaman.terima') }}",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                console.log(data);
                table.ajax.reload();
                $("#modalTerima").modal('hide');
            });

            event.preventDefault();
        });

        function updateTolak(e) {
            $("#id-tolak").val($(e).data("id"))
            $("#namaPeminjamTolak").html($(e).data("nama"));
        }

        $("#form-tolak").submit(function(event) {
            var formData = {
                id: $("#id-tolak").val(),
                alasan: $("#alasan").val()
            };

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "{{ route('peminjaman.tolak') }}",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                console.log(data);
                table.ajax.reload();
                $("#modalTolak").modal('hide');
            });

            event.preventDefault();
        });
    </script>
@endsection
