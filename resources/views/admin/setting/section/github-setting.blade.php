<div class="tab-pane fade {{ Session::has('admin_general_setting_list_style') && Session::get('admin_general_setting_list_style') == 'section_three' ? 'show active' : '' }}"
    id="github-setting" role="tabpanel">
    <form action="{{ route('admin.github-setting.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label">Github Client ID <span class="text-danger">*</span></label>
                <input type="text" name="github_client_id"
                    value="{{ old('github_client_id') ?? config('settings.github_client_id') }}"
                    placeholder="Github Client ID" class="form-control @error('github_client_id') is-invalid @enderror">
                @error('github_client_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label">Github Client Secret <span class="text-danger">*</span></label>
                <input type="text" name="github_client_secret"
                    value="{{ old('github_client_secret') ?? config('settings.github_client_secret') }}"
                    placeholder="Github Client Secret"
                    class="form-control @error('github_client_secret') is-invalid @enderror">
                @error('github_client_secret')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label">Github Redirect URL <span class="text-danger">*</span></label>
                <input type="text" name="github_redirect_url"
                    value="{{ old('github_redirect_url') ?? config('settings.github_redirect_url') }}"
                    placeholder="Github Redirect URL"
                    class="form-control @error('github_redirect_url') is-invalid @enderror">
                @error('github_redirect_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
            </div>
        </div>
    </form>
</div>
