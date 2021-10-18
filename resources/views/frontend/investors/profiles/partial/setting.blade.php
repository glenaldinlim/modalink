<form action="{{ route('front.investor.profiles.setting', ['id' => $user->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card" id="settings-card">
        <div class="card-header">
            <h4>Pengaturan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="old_password" class="form-label label-font">Kata Sandi Lama</label>
                        <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Kata Sandi Lama" required>
                        @error('old_password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('old_password') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password" class="form-label label-font">Kata Sandi Baru</label>
                        <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Kata Sandi Baru" required>
                        @error('new_password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('new_password') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation" class="form-label label-font">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Kata Sandi Baru" required>
                        @error('new_password_confirmation')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-md-right">
            <button class="btn btn-primary" id="save-btn">Simpan</button>
        </div>
    </div>
</form>