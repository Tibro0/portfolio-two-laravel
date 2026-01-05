<div class="tab-pane fade {{ Session::has('admin_general_setting_list_style') && Session::get('admin_general_setting_list_style') == 'section_one' ? 'show active' : '' }} {{ !Session::has('admin_general_setting_list_style') ? 'show active' : '' }}" id="general-setting" role="tabpanel">
    <form action="{{ route('admin.general-setting.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label">Site Name <span class="text-danger">*</span></label>
                <input type="text" name="site_name" value="{{ old('site_name') ?? config('settings.site_name') }}"
                    placeholder="Site Name" class="form-control @error('site_name') is-invalid @enderror">
                @error('site_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
            </div>
        </div>
    </form>
</div>
