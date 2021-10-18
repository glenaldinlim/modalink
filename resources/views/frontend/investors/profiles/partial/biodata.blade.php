<form action="{{ route('front.investor.profiles.biodata', ['id' => $user->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card" id="settings-card">
        <div class="card-header">
            <h4>Data Diri</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="name" class="form-label label-font">Nama</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $user->name }}" placeholder="Nama Pemilik" required>
                        @error('name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label label-font">No Telepon</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?? $user->phone }}" placeholder="No Telepon" required>
                        <small class="form-text text-muted">Ex: 6281200112233</small>
                        @error('phone')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label label-font">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email }}" placeholder="Email" required disabled>
                        @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="job" class="form-label label-font">Pekerjaan</label>
                        <input type="text" name="job" id="job" class="form-control @error('job') is-invalid @enderror" value="{{ old('job') ?? $user->userCredential->job }}" placeholder="Pekerjaan" required>
                        @error('job')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('job') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birthdate" class="form-label label-font">Tanggal Lahir</label>
                        <input type="text" name="birthdate" id="birthdate" class="form-control datemask @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') ?? $user->userCredential->birthdate }}" placeholder="DD/MM/YTYY" required>
                        @error('birthdate')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthdate') }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label label-font d-block">Jenis Kelamin</label>
                        <div class="form-check form-check-inline">
                            <input name="gender" class="form-check-input @error('gender') is-invalid @enderror" type="radio" id="male" value="M" {{ $user->gender == "M" ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="gender" class="form-check-input @error('gender') is-invalid @enderror" type="radio" id="female" value="F" {{ $user->gender == "F" ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">Perempuan</label>
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
        <div class="card-footer text-md-right">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </div>
</form>

@push('js-lib')
    <script src="{{ asset('modules/cleave-js/dist/cleave.min.js') }}"></script>
@endpush

@push('js-additional')
    <script>
        var cleaveD = new Cleave('.datemask', {
            date: true,
            datePattern: ['Y', 'm', 'd']
        });
    </script>
@endpush