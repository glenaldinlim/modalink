@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Verification Status Merchant {{ $merchant->name }}</h1>
        </div>
        <form action="{{ route('backend.merchants.verifications.update', ['id' => $merchant->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="verification_status" class="form-label label-font">Verification Status</label>
                                <select class="form-control @error('verification_status') is-invalid @enderror selectric" id="verification_status" name="verification_status">
                                    <option>-</option>
                                    @foreach ($verificationStatuses as $verification)
                                    <option value="{{ $verification->id }}" {{ $merchant->verification_status_id == $verification->id ? 'selected' : '' }}>{{ $verification->name }}</option>
                                    @endforeach
                                </select>
                                @error('verification_status')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('verification_status') }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="form-label label-font">Merchant Document</label>
                                <p class="m-0">Surat Izin Usaha Perdagangan (SIUP) <a href="{{ $merchant->siup_path != NULL ? asset('storage/'.$merchant->siup_path) : '#' }}" class="text-decoration-none {{ $merchant->siup_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p>
                                <p class="m-0">Nomor Induk Berusaha (NIB) <a href="{{ $merchant->nib_path != NULL ? asset('storage/'.$merchant->nib_path) : '#' }}" class="text-decoration-none {{ $merchant->nib_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p>
                                <p class="m-0">SKDP atau TDP <a href="{{ $merchant->skdp_tdp_path != NULL ? asset('storage/'.$merchant->skdp_tdp_path) : '#' }}" class="text-decoration-none {{ $merchant->skdp_tdp_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p> 
                                <p class="m-0">Akta Perusahaan <a href="{{ $merchant->deed_company_path != NULL ? asset('storage/'.$merchant->deed_company_path) : '#' }}" class="text-decoration-none {{ $merchant->deed_company_path != NULL ? 'text-dark' : 'text-danger' }}">(preview)</a></p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <input type="submit" value="Update" class="btn btn-success btn-text-size">
                </div>
            </div>
        </form>
    </section>
@endsection