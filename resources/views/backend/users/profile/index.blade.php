@extends('layouts.backend.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ $user->name }}</h2>
            <x-alert />
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset('storage/'.$user->avatar) }}" class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Role</div>
                                    <div class="profile-widget-item-value">{{ $user->role_name }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Join at</div>
                                    <div class="profile-widget-item-value">{{ $user->join_year }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name"> 
                                {{ $user->name }} <div class="text-muted d-inline font-weight-normal"> <div class="slash"> </div> {{ $user->role_name }} </div>
                            </div>
                            <div class="information">
                                <b><i class="fas fa-envelope"></i> Email</b>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Change Email</h4>
                        </div>
                        <form method="POST" action="{{ route('backend.users.profiles.update_email', ['id' => $user->id]) }}">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label for="email" class="form-label label-font">Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ? old('email') : $user->email }}" required>
                                        @error('email')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" value="Update Email" class="btn btn-success btn-14">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <form method="post" action="{{ route('backend.users.profiles.update_profile', ['id' => $user->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="name" class="form-label label-font">Full Name</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $user->name }}" placeholder="Full Name" required>
                                        @error('name')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="phone" class="form-label label-font">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ? old('phone') : $user->phone }}" required>
                                        <small class="form-text text-muted">Ex: 6281200112233</small>  
                                        @error('phone')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-0 col-12">
                                        <label for="avatar" class="form-label label-font">Avatar</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control-file @error('avatar') is-invalid @enderror">
                                        <small class="form-text text-muted">Kosongkan Jika Tidak Ingin Mengubah Avatar</small>
                                        <small class="form-text text-muted">Max Size 3 MB</small>
                                        @error('avatar')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" value="Update Profile" class="btn btn-success btn-14">
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Change Password</h4>
                        </div>
                        <form method="post" action="{{ route('backend.users.profiles.update_password', ['id' => $user->id]) }}">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="password" class="form-label label-font">Password</label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" required>
                                        @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">Min 8 Character and Max 16 Character</small>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="password_confirmation" class="form-label label-font">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password Confirmation" required>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" value="Update Password" class="btn btn-success btn-14">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection