@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Fund Type</h1>
        </div>
        <form action="{{ route('backend.funds.types.update', ['id' => $type->id]) }}" method="POST">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="type_name" class="form-label label-font">Type Name</label>
                                <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror" value="{{ old('type_name') ? old('type_name') : $type->name }}" placeholder="Type Name" required>
                                @error('type_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type_name') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label label-font">Status</label>
                                <div class="custom-control custom-radio custom-control">
                                    <input type="radio" id="status_active" name="status_option" class="custom-control-input @error('status_option') is-invalid @enderror" value="1" checked="{{ $type->status }}">
                                    <label class="custom-control-label" for="status_active">Active</label>
                                </div>
                                <div class="custom-control custom-radio custom-control">
                                    <input type="radio" id="status_inactive" name="status_option" class="custom-control-input @error('status_option') is-invalid @enderror" value="0" chekced="{{ $type->status }}">
                                    <label class="custom-control-label" for="status_inactive">Inactive</label>
                                </div>
                                @error('status_option')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status_option') }}</strong>
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
