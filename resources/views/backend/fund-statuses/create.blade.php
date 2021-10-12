@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Fund Status</h1>
        </div>
        <form action="{{ route('backend.funds.statuses.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="status_state" class="form-label label-font">Status State</label>
                                <input type="text" name="status_state" id="status_state" class="form-control @error('status_state') is-invalid @enderror" value="{{ old('status_state') }}" placeholder="Status State" required>
                                @error('status_state')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status_state') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label label-font">Description</label>
                                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="Description">
                                @error('description')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
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
