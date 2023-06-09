@extends('layouts.main')
@section('content')
    <div class="py-5">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="input-group mt-3 mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-qr-code"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Masukkan Kode Transaksi"
                            aria-label="kodePeminjaman" name="kodePeminjaman" id="kodePeminjaman">
                        <span class="invalid-feedback">NOMOR BARCODE TIDAK DIKENAL</span>
                    </div>
                    <hr>
                    <p>*Anggota</p>
                    <div class="bg-light px-2 py-2">
                        <p>
                            Nama &nbsp; : <b id="nama"></b><br>
                            Alamat &nbsp; : <b id="alamat"></b><br>
                            Peminjaman&nbsp; : <b class="text-success" id="peminjaman"></b><br>
                            Jatuh Tempo&nbsp; : <b class="text-success" id="jatuhTempo"></b><br>
                            Pengembalian&nbsp; : <b id="pengembalian"></b><br>
                            Status&nbsp; : <b id="status"></b><br>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <p>*Daftar Pinjaman Buku</p>
                    <table class="table" id="buku_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Label</th>
                            </tr>
                        </thead>
                        <tbody id="first">
                        </tbody>
                    </table>
                    <hr>
                    Jumlah Buku : <b id="jumlahBuku"></b><br>
                    Denda Keterlambatan : <b id="dendaTerlambat"></b><br>

                    <div id="tempatButton" class="mt-3">
                    </div>
                </div>
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


    {{-- Modal Kembalikan --}}
    <div class="modal fade" id="modalKembalikan" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-pengembalian">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" name="id-kembalikan" id="id-kembalikan">
                        <i class="fas fa-exclamation-circle text-warning"></i> Apakah Anda Yakin Akan Mengembalikan
                        Peminjaman
                        Dari
                        <i id="namaPeminjamKembalikan"></i>
                        <input type="hidden" value="" name="denda" id="denda" class="form-control mt-3">
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
    <script src="{{ asset('template/plugins/scanner-detector/scannerDetector.js') }}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });
        })
        $("#kodePeminjaman").scannerDetection({
            timeBeforeScanTest: 200, // wait for the next character for upto 200ms
            avgTimeByChar: 100, // it's not a barcode if a character takes longer than 100ms
            onComplete: function(barcode, qty) {
                $("#kodePeminjaman").val("");
                rest();
                let data = {
                    id: barcode
                }
                $.post("{{ route('transaksi.getdata') }}", data,
                    function(data) {
                        console.log(data);
                        if (data) {
                            // console.log(data);
                            $("#nama").html(data.user.name);
                            $("#alamat").html(data.user.profile.alamat);
                            $("#peminjaman").html(data.tgl_peminjaman);
                            $("#jatuhTempo").html(data.tgl_kembali);
                            $("#pengembalian").html(data.tanggal_pengembalian);
                            $("#status").html(data.status);
                            let no = 0;
                            data.buku.forEach(element => {
                                no++;
                                $('#buku_table > tbody:first').append(`
                            <tr>
                                <td> ` + no + ` </td>
                                <td> ` + element.judul_buku + ` </td>
                                <td> ` + element.pengarang + ` </td>
                                <td> ` + element.penerbit + ` </td>
                                <td> ` + element.label_buku + ` </td>
                            `);

                            });
                            $("#jumlahBuku").html(no)
                            $("#dendaTerlambat").html(data.denda)

                            if (data.status_pinjam == "0") {
                                $("#pengembalian").html("-");
                                // console.log("tes");
                                let btn =
                                    ` <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success w-50" data-id="` + data.id +
                                    ` " data-nama="` + data.user.name + `"  onClick="updateTerima(this)"  data-toggle="modal" data-target="#modalTerima">TERIMA</button>
                            <button type="button" class="btn btn-danger w-50" data-id="` + data.id +
                                    ` " data-nama="` + data.user.name + `"  onClick="updateTolak(this)"  data-toggle="modal" data-target="#modalTolak">TOLAK</button>
                            </div>`;
                                $("#tempatButton").html(btn);
                            } else if (data.status_pinjam == "1") {
                                $("#pengembalian").html(data.tanggal_pengembalian);

                                let btn =
                                    `<button type="button" class="btn btn-success w-100" data-id="` + data
                                    .id +
                                    ` " data-nama="` + data.user.name + `" data-denda="` + data.denda2 +
                                    `" onClick="updatePengembalian(this)"  data-toggle="modal" data-target="#modalKembalikan">KEMBALIKAN</button>`;
                                $("#tempatButton").html(btn);
                            } else {
                                $("#tempatButton").html('');
                            }
                        } else {
                            $("#kodePeminjaman").addClass("is-invalid");
                        }
                    },
                );
            }
        });

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
                rest()
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
                rest()
                $("#modalTolak").modal('hide');
            });
            event.preventDefault();
        });

        function updatePengembalian(e) {
            console.log(e);
            $("#id-kembalikan").val($(e).data("id"))
            $("#denda").val($(e).data("denda"))
            $("#namaPeminjamKembalikan").html($(e).data("nama"));
        }

        $("#form-pengembalian").submit(function(event) {
            var formData = {
                id: $("#id-kembalikan").val(),
                denda: $("#denda").val()
            };

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "{{ route('peminjaman.pengembalian') }}",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(data) {
                rest()
                $("#modalKembalikan").modal('hide');
            });
            event.preventDefault();
        });


        function rest() {
            $("#kodePeminjaman").removeClass("is-invalid");
            $("#buku_table > tbody:first").empty();
            $("#nama").html("");
            $("#alamat").html("");
            $("#peminjaman").html("");
            $("#jatuhTempo").html("");
            $("#pengembalian").html("");
            $("#dendaTerlambat").html("");
            $("#jumlahBuku").html("");
            $("#status").html("");
            $("#tempatButton").html("")
        }
    </script>
@endsection
