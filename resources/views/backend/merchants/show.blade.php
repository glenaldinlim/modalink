@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Merchant Detail Information</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $merchant->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                                    
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                            <div class="information">
                                                <b>Owner</b>
                                                <p>{{ $merchant->user_id }}</p>
                                            </div>
                                            <div class="information">
                                                <b>Merchant Phone</b>
                                                <p>{{ $merchant->phone }}</p>
                                            </div>
                                            <div class="information">
                                                <b>Merchant Exist Since</b>
                                                <p>{{ $merchant->since }}</p>
                                            </div>
                                            <div class="information">
                                                <b>Type</b>
                                                <p>{{ $merchant->business_type_id }}</p>
                                            </div>
                                            <div class="information">
                                                <b>Sector</b>
                                                <p>{{ $merchant->business_category_id }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-sm-6 col-12">
                                            <div class="information">
                                                <b>Merchant Document</b>
                                                <p class="m-0">Surat Izin Usaha Perdagangan (SIUP) <a href="{{ $merchant->siup_path != NULL ? asset('storage/'.$merchant->siup_path) : '#' }}" class="text-decoration-none {{ $merchant->siup_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p>
                                                <p class="m-0">Nomor Induk Berusaha (NIB) <a href="{{ $merchant->nib_path != NULL ? asset('storage/'.$merchant->nib_path) : '#' }}" class="text-decoration-none {{ $merchant->nib_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p>
                                                <p class="m-0">SKDP atau TDP <a href="{{ $merchant->skdp_tdp_path != NULL ? asset('storage/'.$merchant->skdp_tdp_path) : '#' }}" class="text-decoration-none {{ $merchant->skdp_tdp_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p> 
                                                <p class="m-0">Akta Perusahaan <a href="{{ $merchant->deed_company_path != NULL ? asset('storage/'.$merchant->deed_company_path) : '#' }}" class="text-decoration-none {{ $merchant->deed_company_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p> 
                                            </div>
                                            <div class="information">
                                                <b>Status</b>
                                                <p>{{ $merchant->status_id }}</p>
                                            </div>
                                            <div class="information">
                                                <b>Verification Status</b>
                                                <p>{{ $merchant->verification_status_id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h4>Spesifikasi Produk</h4>
                        </div>
                        <div class="card-body">
                            {!! $product->specification !!}
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection