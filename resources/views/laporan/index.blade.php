@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <form id="laporanPost">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>STATUS PINJAMAN</label>
                            <select class="select2 form-control" id="status">
                                <option value="">Semua</option>
                                <option value="0">Pending</option>
                                <option value="1">on Going</option>
                                <option value="2">Selesai</option>
                                <option value="5">di Tolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>TANGGAL AWAL</label>
                        <div class="input-group date" id="tanggalAwal" data-target-input="nearest">
                            <input type="text" id="tglAwal" class="form-control datetimepicker-input"
                                data-target="#tanggalAwal" />
                            <div class="input-group-append" data-target="#tanggalAwal" data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>TANGGAL AKHIR</label>
                        <div class="input-group date" id="tanggalAkhir" data-target-input="nearest">
                            <input type="text" id="tglAkhir" class="form-control datetimepicker-input"
                                data-target="#tanggalAkhir" />
                            <div class="input-group-append" data-target="#tanggalAkhir" data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <label></label>
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-header">
                </div>
                <div class="card-body table-responsive p-2">
                    <table class="table-hover text-nowrap table" id="tableLaporan">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>ALAMAT</th>
                                <th>BUKU</th>
                                <th>STATUS</th>
                                <th>PINJAM</th>
                                <th>JATUH TEMPO</th>
                                <th>KEMBALI</th>
                                <th>DENDA</th>
                            </tr>
                        </thead>
                        <tbody id="first">
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Datepicker -->
    <script>
        var tabel;

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });
            tabel = $("#tableLaporan").dataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'csv'
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('laporan.show') }}",
                    type: "POST",
                    data: function(d) {
                        d.tglAwal = $("#tglAwal").val();
                        d.status = $("#status").find(":selected").val();
                        d.tglAkhir = $("#tglAkhir").val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'buku',
                        name: 'buku'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'tgl_peminjaman',
                        name: 'tgl_peminjaman'
                    },
                    {
                        data: 'jatuh_tempo',
                        name: 'jatuh_tempo'
                    },
                    {
                        data: 'pengembalian',
                        name: 'pengembalian'
                    },
                    {
                        data: 'denda',
                        name: 'denda'
                    },
                ],
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": "_all"
                }],

            });
        });

        $('#tanggalAwal').datetimepicker({
            format: 'L'
        });
        $('#tanggalAkhir').datetimepicker({
            format: 'L'
        });

        $("#laporanPost").on('submit', function(event) {
            console.log(tabel);
            event.preventDefault();
            tabel.api().ajax.reload();
            // let formData = {
            //     tglAwal: $("#tglAwal").val(),
            //     tglAkhir: $("#tglAkhir").val(),
            //     status: $("#status").find(":selected").val()
            // }
            // $.ajax({
            //     type: "POST",
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            //     },
            //     url: "{{ route('laporan.show') }}",
            //     data: formData,
            //     dataType: "json",
            //     encode: true,
            // }).done(function(data) {
            //     console.log(data);
            // });

        })
    </script>
@endsection
