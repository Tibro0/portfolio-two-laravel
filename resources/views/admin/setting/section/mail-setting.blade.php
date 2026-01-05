<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
    <form action="{{ route('admin.mail-setting.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mail Driver <span class="text-danger">*</span></label>
                <input name="mail_driver" type="text" class="form-control @error('mail_driver') is-invalid @enderror"
                    value="{{ config('settings.mail_driver') }}">
                @error('mail_driver')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Mail Host <span class="text-danger">*</span></label>
                <input name="mail_host" type="text" class="form-control @error('mail_host') is-invalid @enderror"
                    value="{{ config('settings.mail_host') }}">
                @error('mail_host')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Mail Port <span class="text-danger">*</span></label>
                <input name="mail_port" type="text" class="form-control @error('mail_port') is-invalid @enderror"
                    value="{{ config('settings.mail_port') }}">
                @error('mail_port')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Mail Username <span class="text-danger">*</span></label>
                <input name="mail_username" type="text"
                    class="form-control @error('mail_username') is-invalid @enderror"
                    value="{{ config('settings.mail_username') }}">
                @error('mail_username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Mail Password <span class="text-danger">*</span></label>
                <input name="mail_password" type="text"
                    class="form-control @error('mail_password') is-invalid @enderror"
                    value="{{ config('settings.mail_password') }}">
                @error('mail_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label">Mail Form Address <span class="text-danger">*</span></label>
                <input name="mail_from_address" type="text" class="form-control"
                    value="{{ config('settings.mail_from_address') }}">
            </div>
            <div class="col-md-12">
                <label class="form-label">Mail Receive Address <span class="text-danger">*</span></label>
                <input name="mail_receive_address" type="text" class="form-control"
                    value="{{ config('settings.mail_receive_address') }}">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
            </div>
        </div>
    </form>
</div>
