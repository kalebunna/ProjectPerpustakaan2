@extends('layouts.main')

@section('content')
    <div class="bg-light mb-4 rounded border p-4 shadow-sm">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded pt-2">
                    <div class="row">
                        <div class="col-lg-3 mb-3">
                            <div class="card border-primary border">
                                <div class="card-body bg-primary d-flex justify-content-between text-light align-middle">
                                    <h1 class="card-text"><i class="fa fa-user-graduate" style="font-size: 3.8rem;"></i>
                                    </h1>
                                    <h1 class="card-text" style="font-size: 3.4rem">{{ $member }} </h1>
                                </div>
                                <div class="card-header d-flex justify-content-between">
                                    <a href="{{ route('member.index') }}" class="text-decoration-none text-secondary">Siswa
                                        Details</a>
                                    <a href="{{ route('member.index') }}"><i
                                            class="fa fa-arrow-circle-right text-secondary"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <div class="card border-primary border">
                                <div class="card-body bg-primary d-flex justify-content-between text-light align-middle">
                                    <h1 class="card-text"><i class="fa fa-book" style="font-size: 3.8rem;"></i>
                                    </h1>
                                    <h1 class="card-text" style="font-size: 3.4rem">{{ $book }} </h1>
                                </div>
                                <div class="card-header d-flex justify-content-between">
                                    <a href="{{ route('buku.index') }}" class="text-decoration-none text-secondary">Buku
                                        Details</a>
                                    <a href="{{ route('buku.index') }}"><i
                                            class="fa fa-arrow-circle-right text-secondary"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <div class="card border-primary border">
                                <div class="card-body bg-primary d-flex justify-content-between text-light align-middle">
                                    <h1 class="card-text"><i class="fa fa-book" style="font-size: 3.8rem;"></i>
                                    </h1>
                                    <h1 class="card-text" style="font-size: 3.4rem">{{ $sekarang }} </h1>
                                </div>
                                <div class="card-header d-flex justify-content-between">
                                    <a href="{{ route('buku.index') }}" class="text-decoration-none text-secondary">Pinjaman
                                        Hari Ini</a>
                                    <a href="{{ route('buku.index') }}"><i
                                            class="fa fa-arrow-circle-right text-secondary"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <div class="card border-primary border">
                                <div class="card-body bg-primary d-flex justify-content-between text-light align-middle">
                                    <h1 class="card-text"><i class="fa fa-book" style="font-size: 3.8rem;"></i>
                                    </h1>
                                    <h1 class="card-text" style="font-size: 3.4rem">{{ $ongoing }} </h1>
                                </div>
                                <div class="card-header d-flex justify-content-between">
                                    <a href="{{ route('buku.index') }}"
                                        class="text-decoration-none text-secondary">Pinjaman On Going</a>
                                    <a href="{{ route('buku.index') }}"><i
                                            class="fa fa-arrow-circle-right text-secondary"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
