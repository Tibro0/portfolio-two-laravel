@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | Update Portfolio
@endsection

@push('css-link')
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Update Portfolio</h5>
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label class="form-label">Image</label><br>
                                    <img src="{{ asset($portfolio->thumb_image) }}" width="100">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Thumb Image <span class="text-danger">*</span> (PNG)</label>
                                    <input type="file" name="thumb_image"
                                        class="form-control @error('thumb_image') is-invalid @enderror"
                                        value="{{ old('thumb_image') }}" placeholder="Thumb Image">
                                    @error('thumb_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category"
                                        class="form-select single-select @error('category') is-invalid @enderror">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option @selected($category->id === $portfolio->category_id) value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <label class="form-label">Frontend Title <span class="text-danger">*</span></label>
                                    <input type="text" name="frontend_title"
                                        class="form-control @error('frontend_title') is-invalid @enderror"
                                        value="{{ old('frontend_title') ?? $portfolio->frontend_title }}"
                                        placeholder="Frontend Title">
                                    @error('frontend_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Frontend Description <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="frontend_description"
                                        class="form-control @error('frontend_description') is-invalid @enderror"
                                        value="{{ old('frontend_description') ?? $portfolio->frontend_description }}"
                                        placeholder="Frontend Description">
                                    @error('frontend_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Preview Title <span class="text-danger">*</span></label>
                                    <input type="text" name="preview_title"
                                        class="form-control @error('preview_title') is-invalid @enderror"
                                        value="{{ old('preview_title') ?? $portfolio->preview_title }}"
                                        placeholder="Preview Title">
                                    @error('preview_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Preview Description <span class="text-danger">*</span></label>
                                    <input type="text" name="preview_description"
                                        class="form-control @error('preview_description') is-invalid @enderror"
                                        value="{{ old('preview_description') ?? $portfolio->preview_description }}"
                                        placeholder="Preview Description">
                                    @error('preview_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Live Link <span class="text-danger">*</span></label>
                                    <input type="text" name="live_link"
                                        class="form-control @error('live_link') is-invalid @enderror"
                                        value="{{ old('live_link') ?? $portfolio->live_link }}" placeholder="Live Link">
                                    @error('live_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Github Link</label>
                                    <input type="text" name="github_link"
                                        class="form-control @error('github_link') is-invalid @enderror"
                                        value="{{ old('github_link') ?? $portfolio->github_link }}"
                                        placeholder="Github Link">
                                    @error('github_link')
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
    </div>
@endsection

@push('js-link')
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endpush
