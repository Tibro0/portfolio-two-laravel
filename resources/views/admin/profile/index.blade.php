@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | Profile
@endsection

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="d-flex align-items-center">Update Profile Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label class="form-label">Preview</label><br>
                                    <img src="{{ asset(auth()->user()->avatar) }}" width="100">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Image (PNG)</label>
                                    <input type="file" name="avatar"
                                        class="form-control @error('avatar') is-invalid @enderror">
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ auth()->user()->name ?? old('name') }}" placeholder="Name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ auth()->user()->email ?? old('email') }}" placeholder="Email"
                                        @readonly(Auth::user()->password === null)>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Phone One <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_one"
                                        class="form-control @error('phone_one') is-invalid @enderror"
                                        value="{{ auth()->user()->phone_one ?? old('phone_one') }}" placeholder="Phone One">
                                    @error('phone_one')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Phone Two</label>
                                    <input type="text" name="phone_two"
                                        class="form-control @error('phone_two') is-invalid @enderror"
                                        value="{{ auth()->user()->phone_two ?? old('phone_two') }}"
                                        placeholder="Phone Two">
                                    @error('phone_two')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Address Line One <span class="text-danger">*</span></label>
                                    <input type="text" name="address_line_one"
                                        class="form-control @error('address_line_one') is-invalid @enderror"
                                        value="{{ auth()->user()->address_line_one ?? old('address_line_one') }}"
                                        placeholder="Address Line One">
                                    @error('address_line_one')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Address Line Two</label>
                                    <input type="text" name="address_line_two"
                                        class="form-control @error('address_line_two') is-invalid @enderror"
                                        value="{{ auth()->user()->address_line_two ?? old('address_line_two') }}"
                                        placeholder="Address Line Two">
                                    @error('address_line_two')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                    <input type="text" name="short_description"
                                        class="form-control @error('short_description') is-invalid @enderror"
                                        value="{{ auth()->user()->short_description ?? old('short_description') }}"
                                        placeholder="Short Description">
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (Auth::user()->password !== null)
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('admin.profile.password.update') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Update Password</h5>
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <label class="form-label">Current Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="current_password"
                                            class="form-control @error('current_password') is-invalid @enderror">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">New Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
