<div class="tab-pane fade {{ Session::has('admin_general_setting_list_style') && Session::get('admin_general_setting_list_style') == 'section_four' ? 'show active' : '' }}"
    id="google-setting" role="tabpanel">
    <form action="{{ route('admin.google-setting.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label">Google Client ID <span class="text-danger">*</span></label>
                <input type="text" name="google_client_id"
                    value="{{ old('google_client_id') ?? config('settings.google_client_id') }}"
                    placeholder="Google Client ID" class="form-control @error('google_client_id') is-invalid @enderror">
                @error('google_client_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label">Google Client Secret <span class="text-danger">*</span></label>
                <input type="text" name="google_client_secret"
                    value="{{ old('google_client_secret') ?? config('settings.google_client_secret') }}"
                    placeholder="Google Client Secret"
                    class="form-control @error('google_client_secret') is-invalid @enderror">
                @error('google_client_secret')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label">Google Redirect URL <span class="text-danger">*</span></label>
                <input type="text" name="google_redirect_url"
                    value="{{ old('google_redirect_url') ?? config('settings.google_redirect_url') }}"
                    placeholder="Google Redirect URL"
                    class="form-control @error('google_redirect_url') is-invalid @enderror">
                @error('google_redirect_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
            </div>
        </div>
    </form>
</div>
