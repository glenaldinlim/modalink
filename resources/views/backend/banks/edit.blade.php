@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Bank Information</h1>
        </div>
        <form action="{{ route('backend.banks.update', ['id' => $bank->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="bank_name" class="form-label label-font">Type Name</label>
                                <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') ? old('bank_name') : $bank->name }}" placeholder="Type Name" required>
                                @error('bank_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label label-font">Status</label>
                                <div class="custom-control custom-radio custom-control">
                                    <input type="radio" id="status_active" name="status_option" class="custom-control-input @error('status_option') is-invalid @enderror" value="1" checked="{{ $bank->status }}">
                                    <label class="custom-control-label" for="status_active">Active</label>
                                </div>
                                <div class="custom-control custom-radio custom-control">
                                    <input type="radio" id="status_inactive" name="status_option" class="custom-control-input @error('status_option') is-invalid @enderror" value="0" chekced="{{ $bank->status }}">
                                    <label class="custom-control-label" for="status_inactive">Inactive</label>
                                </div>
                                @error('status_option')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status_option') }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="bank_logo" class="form-label label-font">Bank Logo</label>
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$bank->logo) }}" width="250px" class="img-fluid"/>
                                </div>
                                <input type="file" name="bank_logo" id="bank_logo" class="form-control-file @error('bank_logo') is-invalid @enderror">
                                <small class="form-text text-muted">Optional | Format: SVG, JPG, JPEG, PNG | Max Size 3MB</small>
                                @error('bank_logo')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_logo') }}</strong>
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
