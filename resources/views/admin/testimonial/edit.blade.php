@extends('admin.layouts.master')

@section('page-title')
    {{ config('app.name') }} | Update Testimonial
@endsection

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Update Testimonial</h5>
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label class="form-label">Preview</label><br>
                                    <img src="{{ asset($testimonial->image) }}" width="100">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Image <span class="text-danger">*</span> (PNG)</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        value="{{ old('image') }}" placeholder="Image">
                                    <input type="hidden" name="old_image" value="{{ $testimonial->image }}">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') ?? $testimonial->name }}" placeholder="Name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Designation <span class="text-danger">*</span></label>
                                    <input type="text" name="designation"
                                        class="form-control @error('designation') is-invalid @enderror"
                                        value="{{ old('designation') ?? $testimonial->designation }}"
                                        placeholder="Designation">
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <input type="text" name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        value="{{ old('description') ?? $testimonial->description }}"
                                        placeholder="Description">
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Ratting <span class="text-danger">*</span> (1 <= 5)</label>
                                            <input type="text" name="ratting"
                                                class="form-control @error('ratting') is-invalid @enderror"
                                                value="{{ old('ratting') ?? $testimonial->ratting }}"
                                                placeholder="Ratting">
                                            @error('ratting')
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
