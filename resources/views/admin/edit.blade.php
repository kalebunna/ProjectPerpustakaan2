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
                    <h2>Edit admin | {{ $admin->name }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"> Nama</label>
                        <div class="input-group">
                            <input value="{{ $admin->name }}" placeholder="Nama" class="form-control" name="name"
                                required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"> Email</label>
                        <div class="input-group">
                            <input type="email" value="{{ $admin->email }}" placeholder="Email" class="form-control"
                                name="email" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"> Password</label>
                        <div class="input-group">
                            <input type="password" value="" placeholder="Password" class="form-control"
                                name="password">
                        </div>
                        <span style="font-style: italic;">kosongkan jika tidak ingin dirubah</span>
                    </div>

                </div>
                <div class="col-xl-6">
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1"> Kelamin</label>
                        <div class="input-group">
                            <select name="kelamin" id="kelamin" class="form-control"required>
                                <option value="L" @if ($admin->profile->kelamin == 'L') selected @endif>Laki-Laki</option>
                                <option value="P" @if ($admin->profile->kelamin != 'L') selected @endif>Perempuan</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1">Alamat</label>
                        <div class="input-group">
                            <input value="{{ $admin->profile->alamat }}" placeholder="ALamat" class="form-control"
                                name="alamat" required>
                        </div>
                    </div>
                    <div class="form-input mb-3">
                        <label for="" class="fw-bold mb-1">NO Telpon</label>
                        <div class="input-group">
                            <input value="{{ $admin->profile->no_telp }}" placeholder="NOMOR TELPON" class="form-control"
                                name="no_telp" required>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-outline-primary fw-bold mt-3 px-4 py-2"><i
                            class="fas fa-save"></i>
                        <div class="d-none d-sm-inline"> Save</div>
                    </button>
                    <button type="button" class="btn btn-outline-secondary fw-bold mt-3 px-4 py-2"><i
                            class="fas fa-caret-square-left"></i>
                        <a class="text-secondary text-secondary-hover d-none d-sm-inline text-decoration-none"
                            href="{{ route('admin.index') }}">
                            Back</a>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Form End -->


    <!-- Content End -->
@endsection
