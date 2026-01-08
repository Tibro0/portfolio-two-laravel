<div class="tab-pane fade {{ Session::has('admin_general_setting_list_style') && Session::get('admin_general_setting_list_style') == 'section_two' ? 'show active' : '' }}"
    id="email-configuration" role="tabpanel">
    <form action="{{ route('admin.mail-setting.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mail Driver <span class="text-danger">*</span></label>
                <input type="text" name="mail_driver"
                    value="{{ old('mail_driver') ?? config('settings.mail_driver') }}" placeholder="smtp"
                    class="form-control @error('mail_driver') is-invalid @enderror">
                @error('mail_driver')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Mail Host <span class="text-danger">*</span></label>
                <input type="text" name="mail_host" value="{{ old('mail_host') ?? config('settings.mail_host') }}"
                    placeholder="smtp.gmail.com" class="form-control @error('mail_host') is-invalid @enderror">
                @error('mail_host')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Mail Port <span class="text-danger">*</span></label>
                <input type="text" name="mail_port" value="{{ old('mail_port') ?? config('settings.mail_port') }}"
                    placeholder="587" class="form-control @error('mail_port') is-invalid @enderror">
                @error('mail_port')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Mail Username <span class="text-danger">*</span></label>
                <input type="text" name="mail_username"
                    value="{{ old('mail_username') ?? config('settings.mail_username') }}"
                    placeholder="faysaltibro@gmail.com"
                    class="form-control @error('mail_username') is-invalid @enderror">
                @error('mail_username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Mail Password <span class="text-danger">*</span></label>
                <input type="text" name="mail_password"
                    value="{{ old('mail_password') ?? config('settings.mail_password') }}"
                    placeholder="wxyxtcbeeonmwcuc" class="form-control @error('mail_password') is-invalid @enderror">
                @error('mail_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label">Mail Form Address <span class="text-danger">*</span></label>
                <input type="text" name="mail_from_address"
                    value="{{ old('mail_from_address') ?? config('settings.mail_from_address') }}"
                    placeholder="faysaltibro@gmail.com"
                    class="form-control @error('mail_from_address') is-invalid @enderror">
                @error('mail_from_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label">Mail Receive Address <span class="text-danger">*</span></label>
                <input type="text" name="mail_receive_address"
                    value="{{ old('mail_receive_address') ?? config('settings.mail_receive_address') }}"
                    placeholder="faysaltibro@gmail.com"
                    class="form-control @error('mail_receive_address') is-invalid @enderror">
                @error('mail_receive_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
            </div>
        </div>
    </form>
</div>
