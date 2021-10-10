@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Bank</h1>
        </div>
        <form action="{{ route('backend.banks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="bank_name" class="form-label label-font">Bank Name</label>
                                <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') }}" placeholder="Bank Name" required>
                                @error('bank_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bank_logo" class="form-label label-font">Bank Logo</label>
                                <input type="file" name="bank_logo" id="bank_logo" class="form-control-file @error('bank_logo') is-invalid @enderror" required>
                                <small class="form-text text-muted">Format: SVG, JPG, JPEG, PNG | Max Size 3MB</small>
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
                    <input type="submit" value="Create" class="btn btn-success btn-text-size">
                    <input type="reset" value="Reset" class="btn btn-danger btn-text-size">
                </div>
            </div>
        </form>
    </section>
@endsection
