<form action="{{ route('front.investor.profiles.bank', ['id' => $user->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card" id="settings-card">
        <div class="card-header">
            <h4>Rekening</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="bank" class="form-label label-font">Bank</label>
                        <select class="form-control @error('bank') is-invalid @enderror selectric" id="bank" name="bank">
                            <option>-</option>
                            @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}" {{ $user->userBankAccount->bank_id == $bank->id ? 'selected' : ''}}>{{ $bank->name }}</option>
                            @endforeach
                        </select>
                        @error('bank')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bank') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="branch" class="form-label label-font">Cabang</label>
                        <input type="text" name="branch" id="branch" class="form-control @error('branch') is-invalid @enderror" value="{{ old('branch') ?? $user->userBankAccount->branch }}" placeholder="Cabang" required>
                        @error('branch')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('branch') }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="account_number" class="form-label label-font">Nomor Rekening</label>
                        <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') ?? $user->userBankAccount->account_number }}" placeholder="Nomor Rekening" required>
                        @error('account_number')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('account_number') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alias_name" class="form-label label-font">Nama Pemilik</label>
                        <input type="text" name="alias_name" id="alias_name" class="form-control @error('alias_name') is-invalid @enderror" value="{{ old('alias_name') ?? $user->userBankAccount->alias_name }}" placeholder="Nama Pemilik" required>
                        @error('alias_name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('alias_name') }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-md-right">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </div>
</form>