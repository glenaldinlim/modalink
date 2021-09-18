@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Category</h1>
        </div>
        <form action="{{ route('backend.businesses.categories.update', ['id' => $category->id]) }}" method="POST">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="category_name" class="form-label label-font">Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') ? old('category_name') : $category->name }}" placeholder="Category Name" required>
                                @error('category_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_name') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_initial" class="form-label label-font">Category Initial (Optional)</label>
                                <input type="text" name="category_initial" id="category_initial" class="form-control @error('category_initial') is-invalid @enderror" value="{{ old('category_initial') ? old('category_initial') : $category->initial }}" placeholder="Category Initial">
                                @error('category_initial')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_initial') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label label-font">Status</label>
                                <div class="custom-control custom-radio custom-control">
                                    <input type="radio" id="status_inactive" name="status_option" class="custom-control-input @error('status_option') is-invalid @enderror" value="0" chekced="{{ $category->status }}">
                                    <label class="custom-control-label" for="status_inactive">Inactive</label>
                                </div>
                                <div class="custom-control custom-radio custom-control">
                                    <input type="radio" id="status_active" name="status_option" class="custom-control-input @error('status_option') is-invalid @enderror" value="1" checked="{{ $category->status }}">
                                    <label class="custom-control-label" for="status_active">Active</label>
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
