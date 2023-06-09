@extends('layouts.main')

@section('content')
    <!-- Panel Start -->
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded p-2">
                    <h2 class="mb-3">Detail Member | {{ $member->name }}</h2>
                    <div class="row mb-2">
                        <div class="col-sm">
                            {{-- @if (auth()->user()->role === 'admin') --}}
                            <a href="{{ route('member.edit', $member->id) }}" class="text-decoration-none text-white">
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
                            {{-- @endif --}}
                            <button type="button" class="btn btn-outline-secondary fw-bold px-4 py-2"><i
                                    class="fas fa-caret-square-left"></i>
                                <a class="text-secondary text-secondary-hover d-none d-sm-inline text-decoration-none"
                                    href="{{ url()->previous() }}"> Back</a>
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
            <div class="col-xl-6">
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1">NIS</label>
                    <div class="input-group">
                        <input value="{{ $member->profile->nim }}" placeholder="NIS" class="form-control" name="nim"
                            disabled>
                    </div>
                </div>
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1"> Nama</label>
                    <div class="input-group">
                        <input value="{{ $member->name }}" placeholder="Nama" class="form-control" name="name" disabled>
                    </div>
                </div>
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1"> Email</label>
                    <div class="input-group">
                        <input type="email" value="{{ $member->email }}" placeholder="Email" class="form-control"
                            name="email" disabled>
                    </div>
                </div>

            </div>
            <div class="col-xl-6">
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1"> Kelamin</label>
                    <div class="input-group">
                        <select name="kelamin" id="kelamin" class="form-control"disabled>
                            <option value="L" @if ($member->profile->kelamin == 'L') selected @endif>Laki-Laki</option>
                            <option value="P" @if ($member->profile->kelamin != 'L') selected @endif>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1"> Agama</label>
                    <div class="input-group">
                        <input value="{{ $member->profile->agama }}" placeholder="Agama" class="form-control" name="agama"
                            disabled>
                    </div>
                </div>
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1"> Tempat Lahir</label>
                    <div class="input-group">
                        <input value="{{ $member->profile->tempat_lahir }}" placeholder="Tempat Lahir" class="form-control"
                            name="tempat_lahir" disabled>
                    </div>
                </div>
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1"> Tanggal Lahir</label>
                    <div class="input-group">
                        <input value="{{ $member->profile->tanggal_lahir }}" placeholder="Tanggal Lahir"
                            class="form-control" name="tanggal_lahir" disabled>
                    </div>
                </div>
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1">Alamat</label>
                    <div class="input-group">
                        <input value="{{ $member->profile->alamat }}" placeholder="ALamat" class="form-control"
                            name="alamat" disabled>
                    </div>
                </div>
                <div class="form-input mb-3">
                    <label for="" class="fw-bold mb-1">NO Telpon</label>
                    <div class="input-group">
                        <input value="{{ $member->profile->no_telp }}" placeholder="NOMOR TELPON" class="form-control"
                            name="no_telp" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
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
                    Menghapus {{ $member->name }}
                </div>
                <div class="modal-footer">
                    <form action="{{ route('member.destroy', $member->id) }}" method="POST">
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
@endsection
