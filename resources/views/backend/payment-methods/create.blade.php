@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Payment Method</h1>
        </div>
        <form action="{{ route('backend.payments.methods.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body m-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="bank" class="form-label label-font">Bank</label>
                                <select class="form-control @error('bank') is-invalid @enderror selectric" id="bank" name="bank">
                                    <option>-</option>
                                    @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                                @error('bank')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pic" class="form-label label-font">PIC</label>
                                <select class="form-control @error('pic') is-invalid @enderror selectric" id="pic" name="pic">
                                    <option>-</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role_name }})</option>
                                    @endforeach
                                </select>
                                @error('pic')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pic') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="account_number" class="form-label label-font">Account Number</label>
                                <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') }}" placeholder="Account Number" required>
                                @error('account_number')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_number') }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alias_name" class="form-label label-font">Alias Name</label>
                                <input type="text" name="alias_name" id="alias_name" class="form-control @error('alias_name') is-invalid @enderror" value="{{ old('alias_name') }}" placeholder="Alias Name">
                                @error('alias_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alias_name') }}</strong>
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
