@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Merchant</h1>
        </div>
        <form action="{{ route('backend.merchants.update', ['id' => $merchant->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="merchant_name" class="form-label label-font">Nama Usaha</label>
                                <input type="text" name="merchant_name" id="merchant_name" class="form-control @error('merchant_name') is-invalid @enderror" value="{{ old('merchant_name') ?? $merchant->name }}" placeholder="Nama Usaha" required>
                                @error('merchant_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('merchant_name') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="merchant_phone" class="form-label label-font">Nomor Telpon Usaha</label>
                                <input type="text" name="merchant_phone" id="merchant_phone" class="form-control @error('merchant_phone') is-invalid @enderror" value="{{ old('merchant_phone') ?? $merchant->phone }}" placeholder="Nama Usaha" required>
                                <small class="text-muted">Format: 6283811223344 atau 0251 25500011</small>
                                @error('merchant_phone')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('merchant_phone') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="year" class="form-label label-font">Tahun berdiri</label>
                                <input type="text" name="year" id="year" class="form-control datemask @error('year') is-invalid @enderror" value="{{ old('year') ?? $merchant->since }}" placeholder="Tahun Berdiri" required>
                                @error('year')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="business_type" class="form-label label-font">Jenis Usaha</label>
                                <select class="form-control @error('business_type') is-invalid @enderror selectric" id="business_type" name="business_type">
                                    <option>-</option>
                                    @foreach ($businessTypes as $type)
                                    <option value="{{ $type->id }}" {{ $merchant->business_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('business_type')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('business_type') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="business_category" class="form-label label-font">Sektor Usaha</label>
                                <select class="form-control @error('business_category') is-invalid @enderror selectric" id="business_category" name="business_category">
                                    <option>-</option>
                                    @foreach ($businessCategories as $category)
                                    <option value="{{ $category->id }}" {{ $merchant->business_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }} {{ $category->initial != NULL ? '('.$category->initial.')' : '' }}</option>
                                    @endforeach
                                </select>
                                @error('business_category')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('business_category') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-label label-font">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror selectric" id="status" name="status">
                                    <option>-</option>
                                    @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $merchant->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </div>
                                @enderror
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

@push('js-lib')
    <script src="{{ asset('modules/cleave-js/dist/cleave.min.js') }}"></script>
@endpush

@push('js-additional')
    <script>
        var cleaveD = new Cleave('.datemask', {
            date: true,
            datePattern: ['Y']
        });
    </script>
@endpush