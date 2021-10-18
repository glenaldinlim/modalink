@extends('layouts.frontend.investors.app')

@section('content')
    <section class="section">
        <x-alert />
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" class="img-fluid rounded-circle">
                            </div>
                            <div class="col-6 text-right">
                                <span class="badge badge-success">Terverifikasi</span>
                            </div>
                            <div class="col-12 mt-3">
                                <h5 class="mb-0">{{ $user->name }}</h5>
                                <p class="text-muted mb-0">{{ $user->userCredential->job }}</p>
                            </div>
                        </div>
                        <hr>
                        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                            <li class="nav-item"><a href="#biodata" class="nav-link active" id="biodata-tab" data-toggle="tab" role="tab" aria-controls="biodata" aria-selected="true">Data Diri</a></li>
                            <li class="nav-item"><a href="#bank" class="nav-link" id="bank-tab" data-toggle="tab" role="tab" aria-controls="bank" aria-selected="false">Rekening</a></li>
                            <li class="nav-item"><a href="#favorite" class="nav-link" id="favorite-tab" data-toggle="tab" role="tab" aria-controls="favorite" aria-selected="false">Favorit</a></li>
                            <li class="nav-item"><a href="#transaction" class="nav-link" id="transaction-tab" data-toggle="tab" role="tab" aria-controls="transaction" aria-selected="false">Riwayat Transaksi</a></li>
                            <li class="nav-item"><a href="#notification" class="nav-link" id="notification-tab" data-toggle="tab" role="tab" aria-controls="notification" aria-selected="false">Notifikasi</a></li>
                            <li class="nav-item"><a href="#setting" class="nav-link" id="setting-tab" data-toggle="tab" role="tab" aria-controls="setting" aria-selected="false">Pengaturan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content no-padding" id="myTab2Content">
                    <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                        @include('frontend.investors.profiles.partial.biodata')
                    </div>
                    <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                        @include('frontend.investors.profiles.partial.bank')
                    </div>
                    <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
                        @include('frontend.investors.profiles.partial.favorite')
                    </div>
                    <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                        @include('frontend.investors.profiles.partial.transaction')
                    </div>
                    <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                        @include('frontend.investors.profiles.partial.notification')
                    </div>
                    <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                        @include('frontend.investors.profiles.partial.setting')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
